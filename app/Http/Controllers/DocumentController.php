<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Document;
use App\Models\DocumentComment;
use App\Models\DocumentHistory;
use App\Models\LoggedHistory;
use App\Models\Notification;
use App\Models\Reminder;
use App\Models\shareDocument;
use App\Models\SubCategory;
use App\Models\Subscription;
use App\Models\Tag;
use App\Models\User;
use App\Models\VersionHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Mail;

class DocumentController extends Controller
{

    public function index()
    {
        if (\Auth::user()->can('manage document')) {
            $documents = Document::where('parent_id', '=', parentId())->get();
            return view('document.index', compact('documents'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }


    public function create()
    {
        $category = Category::where('parent_id', parentId())->get()->pluck('title', 'id');
        $category->prepend(__('Select Category'), '');
        $tages = Tag::where('parent_id', parentId())->get()->pluck('title', 'id');

        return view('document.create', compact('category', 'tages'));
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create document') || \Auth::user()->can('create my document')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'category_id' => 'required',
                    'sub_category_id' => 'required',
                    'document' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $ids = parentId();
            $authUser = \App\Models\User::find($ids);
            $totalDocument = $authUser->totalDocument();
            $subscription = Subscription::find($authUser->subscription);
            if ($totalDocument >= $subscription->total_document && $subscription->total_document != 0) {
                return redirect()->back()->with('error', __('Your document limit is over, please upgrade your subscription.'));
            }

            $document = new Document();
            $document->name = $request->name;
            $document->category_id = $request->category_id;
            $document->sub_category_id = $request->sub_category_id;
            $document->description = $request->description;
            $document->tages = !empty($request->tages) ? implode(',', $request->tages) : '';
            $document->created_by = \Auth::user()->id;
            $document->parent_id = parentId();
            $document->save();

            if (!empty($request->document)) {
                $documentFilenameWithExt = $request->file('document')->getClientOriginalName();
                $documentFilename = pathinfo($documentFilenameWithExt, PATHINFO_FILENAME);
                $documentExtension = $request->file('document')->getClientOriginalExtension();
                $documentFileName = time() . '.' . $documentExtension;

                $dir = storage_path('upload/document');
                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                $request->file('document')->storeAs('upload/document/', $documentFileName);
                $version = new VersionHistory();
                $version->document = $documentFileName;
                $version->current_version = 1;
                $version->document_id = $document->id;
                $version->created_by = \Auth::user()->id;
                $version->parent_id = parentId();
                $version->save();
            }

            $data['document_id'] = $document->id;
            $data['action'] = __('Document Create');
            $data['description'] = __('New document') . ' ' . $document->name . ' ' . __('created by') . ' ' . \Auth::user()->name;
            DocumentHistory::history($data);

            return redirect()->back()->with('success', __('Document successfully created!'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }


    public function show($cid)
    {
        $id = Crypt::decrypt($cid);
        $document = Document::find($id);
        $latestVersion = VersionHistory::where('document_id', $id)->where('current_version', 1)->first();
        return view('document.show', compact('document', 'latestVersion'));
    }


    public function edit(Document $document)
    {
        $category = Category::where('parent_id', parentId())->get()->pluck('title', 'id');
        $category->prepend(__('Select Category'), '');
        $tages = Tag::where('parent_id', parentId())->get()->pluck('title', 'id');

        return view('document.edit', compact('document', 'category', 'tages'));
    }


    public function update(Request $request, Document $document)
    {
        if (\Auth::user()->can('edit document') || \Auth::user()->can('create my document')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'category_id' => 'required',
                    'sub_category_id' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $document->name = $request->name;
            $document->category_id = $request->category_id;
            $document->sub_category_id = $request->sub_category_id;
            $document->description = $request->description;
            $document->tages = !empty($request->tages) ? implode(',', $request->tages) : '';
            $document->save();

            $data['document_id'] = $document->id;
            $data['action'] = __('Document Update');
            $data['description'] = __('Document update') . ' ' . $document->name . ' ' . __('updated by') . ' ' . \Auth::user()->name;
            DocumentHistory::history($data);

            return redirect()->back()->with('success', __('Document successfully created!'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }


    public function destroy(Document $document)
    {
        if (\Auth::user()->can('delete document')) {
            $document->delete();

            $data['document_id'] = $document->id;
            $data['action'] = __('Document Delete');
            $data['description'] = __('Document delete') . ' ' . $document->name . ' ' . __('deleted by') . ' ' . \Auth::user()->name;
            DocumentHistory::history($data);

            return redirect()->back()->with('success', 'Document successfully deleted!');
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function myDocument()
    {
        if (\Auth::user()->can('manage my document')) {
            $assign_doc = shareDocument::where('user_id', \Auth::user()->id)->get()->pluck('document_id');

            $documents = Document::where('created_by', '=', \Auth::user()->id);
            if (!empty($assign_doc)) {
                $documents->orWhereIn('id', $assign_doc);
            }

            $documents = $documents->get();
            return view('document.own', compact('documents'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function comment($ids)
    {
        if (\Auth::user()->can('manage comment')) {
            $id = Crypt::decrypt($ids);
            $document = Document::find($id);
            $comments = DocumentComment::where('document_id', $id)->get();
            return view('document.comment', compact('document', 'comments'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function commentData(Request $request, $ids)
    {
        if (\Auth::user()->can('create comment')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'comment' => 'required',

                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $id = Crypt::decrypt($ids);
            $document = Document::find($id);
            $comment = new DocumentComment();
            $comment->comment = $request->comment;
            $comment->user_id = \Auth::user()->id;
            $comment->document_id = $document->id;
            $comment->parent_id = parentId();
            $comment->save();

            $data['document_id'] = $document->id;
            $data['action'] = __('Comment Create');
            $data['description'] = __('Comment create for') . ' ' . $document->name . ' ' . __('commented by') . ' ' . \Auth::user()->name;
            DocumentHistory::history($data);

            return redirect()->back()->with('success', 'Document comment successfully created!');
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function reminder($ids)
    {
        if (\Auth::user()->can('manage reminder')) {
            $id = Crypt::decrypt($ids);
            $document = Document::find($id);
            $reminders = Reminder::where('document_id', $id)->get();
            $users = User::where('parent_id', parentId())->get()->pluck('name', 'id');
            return view('document.reminder', compact('document', 'reminders', 'users'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }
    public function addReminder($id)
    {
        if (\Auth::user()->can('create reminder')) {
            $document = Document::find($id);
            $reminders = Reminder::where('document_id', $id)->get();
            $users = User::where('parent_id', parentId())->get()->pluck('name', 'id');
            return view('document.add_reminder', compact('document', 'reminders', 'users'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function versionHistory($ids)
    {
        if (\Auth::user()->can('manage version')) {
            $id = Crypt::decrypt($ids);
            $document = Document::find($id);
            $versions = VersionHistory::where('document_id', $id)->get();

            return view('document.version_history', compact('document', 'versions'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function newVersion(Request $request, $ids)
    {
        if (\Auth::user()->can('create version')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'document' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $id = Crypt::decrypt($ids);

            VersionHistory::where('document_id', $id)->update(['current_version' => 0]);
            if (!empty($request->document)) {
                $documentFilenameWithExt = $request->file('document')->getClientOriginalName();
                $documentFilename = pathinfo($documentFilenameWithExt, PATHINFO_FILENAME);
                $documentExtension = $request->file('document')->getClientOriginalExtension();
                $documentFileName = time() . '.' . $documentExtension;

                $dir = storage_path('upload/document');
                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                $request->file('document')->storeAs('upload/document/', $documentFileName);
                $version = new VersionHistory();
                $version->document = $documentFileName;
                $version->current_version = 1;
                $version->document_id = $id;
                $version->created_by = \Auth::user()->id;
                $version->parent_id = parentId();
                $version->save();
            }
            $document = Document::find($id);
            $data['document_id'] = $id;
            $data['action'] = __('New version');
            $data['description'] = __('Upload new version for') . ' ' . $document->name . ' ' . __('uploaded by') . ' ' . \Auth::user()->name;
            DocumentHistory::history($data);

            return redirect()->back()->with('success', __('New version successfully uploaded!'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function shareDocument($ids)
    {
        if (\Auth::user()->can('manage share document')) {
            $id = Crypt::decrypt($ids);
            $document = Document::find($id);
            $shareDocuments = shareDocument::where('document_id', $id)->get();
            $users = User::where('parent_id', parentId())->get()->pluck('name', 'id');
            return view('document.share', compact('document', 'shareDocuments', 'users'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }
    public function addshareDocumentData($id)
    {
        if (\Auth::user()->can('create share document')) {
            $document = Document::find($id);
            $shareDocuments = shareDocument::where('document_id', $id)->get();
            $users = User::where('parent_id', parentId())->get()->pluck('name', 'id');
            return view('document.add_share', compact('document', 'shareDocuments', 'users'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function shareDocumentData(Request $request, $ids)
    {
        if (\Auth::user()->can('create share document')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'assign_user' => 'required',
                ]
            );
            if (isset($request->time_duration)) {
                $validator = \Validator::make(
                    $request->all(),
                    [
                        'start_date' => 'required',
                        'end_date' => 'required',
                    ]
                );
            }
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            foreach ($request->assign_user as $user) {
                $share = new shareDocument();
                $share->user_id = $user;
                $share->document_id = $request->document_id;
                if (!empty($request->start_date) && !empty($request->end_date)) {
                    $share->start_date = $request->start_date;
                    $share->end_date = $request->end_date;
                }
                $share->parent_id = parentId();
                $share->save();
            }
            $id = Crypt::decrypt($ids);
            $document = Document::find($id);
            $data['document_id'] = $id;
            $data['action'] = __('Share document');
            $data['description'] = __('Share document') . ' ' . $document->name . ' ' . __('shared by') . ' ' . \Auth::user()->name;
            DocumentHistory::history($data);

            // Handle notifications and emails
            $module = 'document_share';
            $notification = Notification::where('parent_id', parentId())->where('module', $module)->first();
            $setting = settings();
            $errorMessage = '';
            if (!empty($notification) && $notification->enabled_email == 1) {
                $notification_responce = MessageReplace($notification, $request->document_id);

                // Fetch users and their emails
                $users = User::whereIn('id', $request->assign_user)->get();
                $to = $users->pluck('email')->toArray();

                if (!empty($to)) {
                    $datas = [
                        'user'    => $users,
                        'subject' => $notification_responce['subject'],
                        'message' => $notification_responce['message'],
                        'module'  => $module,
                        'logo'    => $setting['company_logo'],
                    ];
                    // Send emails to all recipients
                    $response = commonEmailSend($to, $datas);
                    if ($response['status'] == 'error') {
                        $errorMessage = $response['message'];
                    }
                }
            }

            return redirect()->back()->with('success', __('Document successfully assigned!') . '</br>' . $errorMessage);
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function shareDocumentDelete($id)
    {
        if (\Auth::user()->can('delete share document')) {

            $shareDoc = shareDocument::find($id);
            $document = Document::find($shareDoc->document_id);
            $shareDoc->delete();

            $data['document_id'] = $id;
            $data['action'] = __('Share document delete');
            $data['description'] = __('Share document') . ' ' . $document->name . ' ' . __('delete,deleted by') . ' ' . \Auth::user()->name;
            DocumentHistory::history($data);

            return redirect()->back()->with('success', 'Assigned document successfully removed!');
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function sendEmail($ids)
    {
        if (\Auth::user()->can('manage mail')) {
            $id = Crypt::decrypt($ids);
            $document = Document::find($id);

            return view('document.send_email', compact('document'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function sendEmailData(Request $request, $ids)
    {
        if (\Auth::user()->can('send mail')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'email' => 'required',
                    'subject' => 'required',
                    'message' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            // Handle notifications and emails

            $to = $request->email;
            $errorMessage = '';
            if (!empty($to)) {
                $datas = [
                    'subject' => $request->subject,
                    'message' => $request->message,
                    'module'  => 'send_email',
                    'logo'    => settings()['company_logo'],
                ];

                // Send emails to all recipients
                $response = commonEmailSend($to, $datas);
                if ($response['status'] == 'error') {
                    $errorMessage = $response['message'];
                }
            }

            $id = Crypt::decrypt($ids);
            $document = Document::find($id);
            $data['document_id'] = $id;
            $data['action'] = __('Mail send');
            $data['description'] = __('Mail send for') . ' ' . $document->name . ' ' . __('sended by') . ' ' . \Auth::user()->name;
            DocumentHistory::history($data);

            return redirect()->back()->with('success', __('Mail successfully sent!') . '</br>' . $errorMessage);
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function history()
    {
        $ids = parentId();
        $authUser = \App\Models\User::find($ids);
        $subscription = \App\Models\Subscription::find($authUser->subscription);

        if (\Auth::user()->can('manage document history') && $subscription->enabled_document_history == 1) {
            $histories = DocumentHistory::where('parent_id', parentId())->get();
            return view('document.history', compact('histories'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function loggedHistory()
    {
        $ids = parentId();
        $authUser = \App\Models\User::find($ids);
        $subscription = \App\Models\Subscription::find($authUser->subscription);

        if (\Auth::user()->can('manage logged history') && $subscription->enabled_logged_history == 1) {
            $histories = LoggedHistory::where('parent_id', parentId())->get();
            return view('logged_history.index', compact('histories'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function loggedHistoryShow($id)
    {
        if (\Auth::user()->can('manage logged history')) {
            $histories = LoggedHistory::find($id);
            return view('logged_history.show', compact('histories'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function loggedHistoryDestroy($id)
    {
        if (\Auth::user()->can('delete logged history')) {
            $histories = LoggedHistory::find($id);
            $histories->delete();
            return redirect()->back()->with('success', 'Logged history succefully deleted!');
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }
}
