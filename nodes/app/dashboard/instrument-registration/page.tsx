import type { Metadata } from "next"
import { Button } from "@/components/ui/button"
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card"
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs"
import { InstrumentList } from "@/components/instrument-registration/instrument-list"

export const metadata: Metadata = {
  title: "Instrument Registration | Land Registry System",
  description: "Register and manage legal instruments related to property",
}

export default function InstrumentRegistrationPage() {
  return (
    <div className="flex flex-col gap-6">
      <div className="flex items-center justify-between">
        <h1 className="text-3xl font-bold tracking-tight">Instrument Registration</h1>
        <Button>Register New Instrument</Button>
      </div>

      <Tabs defaultValue="all">
        <TabsList>
          <TabsTrigger value="all">All Instruments</TabsTrigger>
          <TabsTrigger value="deeds">Deeds</TabsTrigger>
          <TabsTrigger value="mortgages">Mortgages</TabsTrigger>
          <TabsTrigger value="leases">Leases</TabsTrigger>
          <TabsTrigger value="other">Other</TabsTrigger>
        </TabsList>
        <TabsContent value="all">
          <Card>
            <CardHeader>
              <CardTitle>All Registered Instruments</CardTitle>
              <CardDescription>View and manage all registered legal instruments</CardDescription>
            </CardHeader>
            <CardContent>
              <InstrumentList />
            </CardContent>
          </Card>
        </TabsContent>
        <TabsContent value="deeds">
          <Card>
            <CardHeader>
              <CardTitle>Deeds</CardTitle>
              <CardDescription>View and manage registered deeds</CardDescription>
            </CardHeader>
            <CardContent>
              <InstrumentList type="deed" />
            </CardContent>
          </Card>
        </TabsContent>
        <TabsContent value="mortgages">
          <Card>
            <CardHeader>
              <CardTitle>Mortgages</CardTitle>
              <CardDescription>View and manage registered mortgages</CardDescription>
            </CardHeader>
            <CardContent>
              <InstrumentList type="mortgage" />
            </CardContent>
          </Card>
        </TabsContent>
        <TabsContent value="leases">
          <Card>
            <CardHeader>
              <CardTitle>Leases</CardTitle>
              <CardDescription>View and manage registered leases</CardDescription>
            </CardHeader>
            <CardContent>
              <InstrumentList type="lease" />
            </CardContent>
          </Card>
        </TabsContent>
        <TabsContent value="other">
          <Card>
            <CardHeader>
              <CardTitle>Other Instruments</CardTitle>
              <CardDescription>View and manage other registered instruments</CardDescription>
            </CardHeader>
            <CardContent>
              <InstrumentList type="other" />
            </CardContent>
          </Card>
        </TabsContent>
      </Tabs>
    </div>
  )
}

