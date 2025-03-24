import type { Metadata } from "next"
import { Button } from "@/components/ui/button"
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card"
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs"
import { PlotList } from "@/components/plot-allocation/plot-list"

export const metadata: Metadata = {
  title: "Plot Allocation | Land Registry System",
  description: "Manage property plots and allocations",
}

export default function PlotAllocationPage() {
  return (
    <div className="flex flex-col gap-6">
      <div className="flex items-center justify-between">
        <h1 className="text-3xl font-bold tracking-tight">Plot Allocation</h1>
        <Button>New Allocation</Button>
      </div>

      <Tabs defaultValue="all-plots">
        <TabsList>
          <TabsTrigger value="all-plots">All Plots</TabsTrigger>
          <TabsTrigger value="allocated">Allocated</TabsTrigger>
          <TabsTrigger value="available">Available</TabsTrigger>
          <TabsTrigger value="pending">Pending Approval</TabsTrigger>
        </TabsList>
        <TabsContent value="all-plots">
          <Card>
            <CardHeader>
              <CardTitle>All Plots</CardTitle>
              <CardDescription>View and manage all registered plots in the system</CardDescription>
            </CardHeader>
            <CardContent>
              <PlotList />
            </CardContent>
          </Card>
        </TabsContent>
        <TabsContent value="allocated">
          <Card>
            <CardHeader>
              <CardTitle>Allocated Plots</CardTitle>
              <CardDescription>View and manage plots that have been allocated to owners</CardDescription>
            </CardHeader>
            <CardContent>
              <PlotList status="allocated" />
            </CardContent>
          </Card>
        </TabsContent>
        <TabsContent value="available">
          <Card>
            <CardHeader>
              <CardTitle>Available Plots</CardTitle>
              <CardDescription>View and manage plots that are available for allocation</CardDescription>
            </CardHeader>
            <CardContent>
              <PlotList status="available" />
            </CardContent>
          </Card>
        </TabsContent>
        <TabsContent value="pending">
          <Card>
            <CardHeader>
              <CardTitle>Pending Approval</CardTitle>
              <CardDescription>View and manage plots that are pending approval</CardDescription>
            </CardHeader>
            <CardContent>
              <PlotList status="pending" />
            </CardContent>
          </Card>
        </TabsContent>
      </Tabs>
    </div>
  )
}

