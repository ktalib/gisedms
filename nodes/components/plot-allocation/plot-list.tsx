"use client"

import { useState } from "react"
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from "@/components/ui/table"
import { Button } from "@/components/ui/button"
import { Input } from "@/components/ui/input"
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuLabel,
  DropdownMenuSeparator,
  DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu"
import { MoreHorizontal, Search } from "lucide-react"

// Mock data for plots
const mockPlots = [
  {
    id: "P001",
    plotNumber: "A-123",
    location: "North District",
    size: "0.5 acres",
    status: "allocated",
    owner: "John Smith",
    dateAllocated: "2023-05-15",
  },
  {
    id: "P002",
    plotNumber: "B-456",
    location: "East District",
    size: "0.75 acres",
    status: "available",
    owner: null,
    dateAllocated: null,
  },
  {
    id: "P003",
    plotNumber: "C-789",
    location: "West District",
    size: "1.2 acres",
    status: "pending",
    owner: "Sarah Johnson",
    dateAllocated: null,
  },
  {
    id: "P004",
    plotNumber: "D-012",
    location: "South District",
    size: "0.8 acres",
    status: "allocated",
    owner: "Michael Brown",
    dateAllocated: "2023-08-22",
  },
  {
    id: "P005",
    plotNumber: "E-345",
    location: "Central District",
    size: "1.5 acres",
    status: "available",
    owner: null,
    dateAllocated: null,
  },
]

export function PlotList({ status }: { status?: string }) {
  const [searchQuery, setSearchQuery] = useState("")

  // Filter plots based on status if provided
  const filteredPlots = mockPlots.filter(
    (plot) =>
      (!status || plot.status === status) &&
      (plot.plotNumber.toLowerCase().includes(searchQuery.toLowerCase()) ||
        plot.location.toLowerCase().includes(searchQuery.toLowerCase()) ||
        (plot.owner && plot.owner.toLowerCase().includes(searchQuery.toLowerCase()))),
  )

  return (
    <div className="space-y-4">
      <div className="flex items-center gap-2">
        <div className="relative flex-1">
          <Search className="absolute left-2.5 top-2.5 h-4 w-4 text-muted-foreground" />
          <Input
            type="search"
            placeholder="Search plots..."
            className="pl-8"
            value={searchQuery}
            onChange={(e) => setSearchQuery(e.target.value)}
          />
        </div>
      </div>

      <div className="rounded-md border">
        <Table>
          <TableHeader>
            <TableRow>
              <TableHead>Plot Number</TableHead>
              <TableHead>Location</TableHead>
              <TableHead>Size</TableHead>
              <TableHead>Status</TableHead>
              <TableHead>Owner</TableHead>
              <TableHead>Date Allocated</TableHead>
              <TableHead className="w-[80px]"></TableHead>
            </TableRow>
          </TableHeader>
          <TableBody>
            {filteredPlots.length === 0 ? (
              <TableRow>
                <TableCell colSpan={7} className="h-24 text-center">
                  No plots found.
                </TableCell>
              </TableRow>
            ) : (
              filteredPlots.map((plot) => (
                <TableRow key={plot.id}>
                  <TableCell className="font-medium">{plot.plotNumber}</TableCell>
                  <TableCell>{plot.location}</TableCell>
                  <TableCell>{plot.size}</TableCell>
                  <TableCell>
                    <span
                      className={`inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium ${
                        plot.status === "allocated"
                          ? "bg-green-100 text-green-800"
                          : plot.status === "pending"
                            ? "bg-yellow-100 text-yellow-800"
                            : "bg-blue-100 text-blue-800"
                      }`}
                    >
                      {plot.status.charAt(0).toUpperCase() + plot.status.slice(1)}
                    </span>
                  </TableCell>
                  <TableCell>{plot.owner || "—"}</TableCell>
                  <TableCell>{plot.dateAllocated || "—"}</TableCell>
                  <TableCell>
                    <DropdownMenu>
                      <DropdownMenuTrigger asChild>
                        <Button variant="ghost" size="icon">
                          <MoreHorizontal className="h-4 w-4" />
                          <span className="sr-only">Actions</span>
                        </Button>
                      </DropdownMenuTrigger>
                      <DropdownMenuContent align="end">
                        <DropdownMenuLabel>Actions</DropdownMenuLabel>
                        <DropdownMenuSeparator />
                        <DropdownMenuItem>View Details</DropdownMenuItem>
                        <DropdownMenuItem>Edit Plot</DropdownMenuItem>
                        {plot.status === "available" && <DropdownMenuItem>Allocate Plot</DropdownMenuItem>}
                        {plot.status === "pending" && <DropdownMenuItem>Approve Allocation</DropdownMenuItem>}
                        {plot.status === "allocated" && <DropdownMenuItem>View Title</DropdownMenuItem>}
                      </DropdownMenuContent>
                    </DropdownMenu>
                  </TableCell>
                </TableRow>
              ))
            )}
          </TableBody>
        </Table>
      </div>
    </div>
  )
}

