"use client"

import { Button } from "@/components/ui/button"
import { Clock, ExternalLink } from "lucide-react"

// Mock data for search history
const mockSearchHistory = [
  {
    id: "S001",
    searchType: "plotNumber",
    searchQuery: "A-123",
    timestamp: "2023-11-28T14:30:00",
    status: "completed",
  },
  {
    id: "S002",
    searchType: "ownerName",
    searchQuery: "John Smith",
    timestamp: "2023-11-27T10:15:00",
    status: "completed",
  },
  {
    id: "S003",
    searchType: "registrationNumber",
    searchQuery: "REG-2023-001",
    timestamp: "2023-11-25T16:45:00",
    status: "completed",
  },
  {
    id: "S004",
    searchType: "titleNumber",
    searchQuery: "T-2023-456",
    timestamp: "2023-11-24T09:20:00",
    status: "completed",
  },
  {
    id: "S005",
    searchType: "address",
    searchQuery: "123 Main St",
    timestamp: "2023-11-22T13:10:00",
    status: "completed",
  },
]

export function SearchHistory() {
  // Format date for display
  const formatDate = (dateString: string) => {
    const date = new Date(dateString)
    return new Intl.DateTimeFormat("en-US", {
      month: "short",
      day: "numeric",
      hour: "2-digit",
      minute: "2-digit",
    }).format(date)
  }

  // Get search type display name
  const getSearchTypeDisplay = (type: string) => {
    const types: Record<string, string> = {
      plotNumber: "Plot Number",
      ownerName: "Owner Name",
      registrationNumber: "Registration Number",
      titleNumber: "Title Number",
      address: "Property Address",
    }
    return types[type] || type
  }

  return (
    <div className="space-y-4">
      {mockSearchHistory.length === 0 ? (
        <p className="text-center text-muted-foreground">No recent searches</p>
      ) : (
        <div className="space-y-4">
          {mockSearchHistory.map((search) => (
            <div key={search.id} className="flex items-start space-x-4 rounded-md border p-4">
              <Clock className="mt-0.5 h-5 w-5 text-muted-foreground" />
              <div className="flex-1 space-y-1">
                <p className="font-medium leading-none">
                  {getSearchTypeDisplay(search.searchType)}: {search.searchQuery}
                </p>
                <p className="text-sm text-muted-foreground">{formatDate(search.timestamp)}</p>
              </div>
              <Button variant="ghost" size="icon">
                <ExternalLink className="h-4 w-4" />
                <span className="sr-only">View results</span>
              </Button>
            </div>
          ))}
        </div>
      )}
    </div>
  )
}

