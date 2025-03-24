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
import { Eye, FileText, MoreHorizontal, Search } from "lucide-react"

// Mock data for instruments
const mockInstruments = [
  {
    id: "I001",
    registrationNumber: "REG-2023-001",
    type: "deed",
    title: "Transfer Deed",
    parties: "John Smith, Sarah Johnson",
    property: "Plot #A-123",
    dateRegistered: "2023-05-15",
    status: "active",
  },
  {
    id: "I002",
    registrationNumber: "REG-2023-002",
    type: "mortgage",
    title: "Mortgage Agreement",
    parties: "Michael Brown, First National Bank",
    property: "Plot #D-012",
    dateRegistered: "2023-08-22",
    status: "active",
  },
  {
    id: "I003",
    registrationNumber: "REG-2023-003",
    type: "lease",
    title: "Commercial Lease",
    parties: "ABC Corporation, XYZ Properties",
    property: "Plot #B-456",
    dateRegistered: "2023-09-10",
    status: "active",
  },
  {
    id: "I004",
    registrationNumber: "REG-2023-004",
    type: "other",
    title: "Easement Agreement",
    parties: "Emily Davis, Robert Wilson",
    property: "Plot #E-345",
    dateRegistered: "2023-10-05",
    status: "pending",
  },
  {
    id: "I005",
    registrationNumber: "REG-2023-005",
    type: "deed",
    title: "Gift Deed",
    parties: "James Anderson, Thomas Anderson",
    property: "Plot #C-789",
    dateRegistered: "2023-11-18",
    status: "active",
  },
]

export function InstrumentList({ type }: { type?: string }) {
  const [searchQuery, setSearchQuery] = useState("")

  // Filter instruments based on type if provided
  const filteredInstruments = mockInstruments.filter(
    (instrument) =>
      (!type || instrument.type === type) &&
      (instrument.registrationNumber.toLowerCase().includes(searchQuery.toLowerCase()) ||
        instrument.title.toLowerCase().includes(searchQuery.toLowerCase()) ||
        instrument.parties.toLowerCase().includes(searchQuery.toLowerCase()) ||
        instrument.property.toLowerCase().includes(searchQuery.toLowerCase())),
  )

  return (
    <div className="space-y-4">
      <div className="flex items-center gap-2">
        <div className="relative flex-1">
          <Search className="absolute left-2.5 top-2.5 h-4 w-4 text-muted-foreground" />
          <Input
            type="search"
            placeholder="Search instruments..."
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
              <TableHead>Registration Number</TableHead>
              <TableHead>Type</TableHead>
              <TableHead>Title</TableHead>
              <TableHead>Parties</TableHead>
              <TableHead>Property</TableHead>
              <TableHead>Date Registered</TableHead>
              <TableHead>Status</TableHead>
              <TableHead className="w-[80px]"></TableHead>
            </TableRow>
          </TableHeader>
          <TableBody>
            {filteredInstruments.length === 0 ? (
              <TableRow>
                <TableCell colSpan={8} className="h-24 text-center">
                  No instruments found.
                </TableCell>
              </TableRow>
            ) : (
              filteredInstruments.map((instrument) => (
                <TableRow key={instrument.id}>
                  <TableCell className="font-medium">{instrument.registrationNumber}</TableCell>
                  <TableCell className="capitalize">{instrument.type}</TableCell>
                  <TableCell>{instrument.title}</TableCell>
                  <TableCell>{instrument.parties}</TableCell>
                  <TableCell>{instrument.property}</TableCell>
                  <TableCell>{instrument.dateRegistered}</TableCell>
                  <TableCell>
                    <span
                      className={`inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium ${
                        instrument.status === "active" ? "bg-green-100 text-green-800" : "bg-yellow-100 text-yellow-800"
                      }`}
                    >
                      {instrument.status.charAt(0).toUpperCase() + instrument.status.slice(1)}
                    </span>
                  </TableCell>
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
                        <DropdownMenuItem>
                          <Eye className="mr-2 h-4 w-4" />
                          View Details
                        </DropdownMenuItem>
                        <DropdownMenuItem>
                          <FileText className="mr-2 h-4 w-4" />
                          View Document
                        </DropdownMenuItem>
                        <DropdownMenuItem>Edit</DropdownMenuItem>
                        {instrument.status === "pending" && <DropdownMenuItem>Approve</DropdownMenuItem>}
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

