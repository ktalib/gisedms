import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar"

const activities = [
  {
    id: "1",
    user: {
      name: "John Smith",
      email: "john.smith@example.com",
      avatar: "/placeholder.svg",
      initials: "JS",
    },
    action: "registered a new title",
    target: "Plot #A-123",
    timestamp: "2 hours ago",
  },
  {
    id: "2",
    user: {
      name: "Sarah Johnson",
      email: "sarah.johnson@example.com",
      avatar: "/placeholder.svg",
      initials: "SJ",
    },
    action: "submitted a legal search request",
    target: "Property #B-456",
    timestamp: "4 hours ago",
  },
  {
    id: "3",
    user: {
      name: "Michael Brown",
      email: "michael.brown@example.com",
      avatar: "/placeholder.svg",
      initials: "MB",
    },
    action: "made a payment",
    target: "$1,250.00",
    timestamp: "Yesterday",
  },
  {
    id: "4",
    user: {
      name: "Emily Davis",
      email: "emily.davis@example.com",
      avatar: "/placeholder.svg",
      initials: "ED",
    },
    action: "allocated a new plot",
    target: "Plot #C-789",
    timestamp: "Yesterday",
  },
  {
    id: "5",
    user: {
      name: "Robert Wilson",
      email: "robert.wilson@example.com",
      avatar: "/placeholder.svg",
      initials: "RW",
    },
    action: "updated customer information",
    target: "Customer #12345",
    timestamp: "2 days ago",
  },
]

export function RecentActivity() {
  return (
    <div className="space-y-8">
      {activities.map((activity) => (
        <div key={activity.id} className="flex items-center">
          <Avatar className="h-9 w-9">
            <AvatarImage src={activity.user.avatar} alt={activity.user.name} />
            <AvatarFallback>{activity.user.initials}</AvatarFallback>
          </Avatar>
          <div className="ml-4 space-y-1">
            <p className="text-sm font-medium leading-none">{activity.user.name}</p>
            <p className="text-sm text-muted-foreground">
              {activity.action} <span className="font-medium">{activity.target}</span>
            </p>
          </div>
          <div className="ml-auto text-xs text-muted-foreground">{activity.timestamp}</div>
        </div>
      ))}
    </div>
  )
}

