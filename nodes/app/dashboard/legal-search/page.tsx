import type { Metadata } from "next"
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card"
import { LegalSearchForm } from "@/components/legal-search/legal-search-form"
import { SearchHistory } from "@/components/legal-search/search-history"

export const metadata: Metadata = {
  title: "Legal Search | Land Registry System",
  description: "Search for legal records and property information",
}

export default function LegalSearchPage() {
  return (
    <div className="flex flex-col gap-6">
      <h1 className="text-3xl font-bold tracking-tight">Legal Search</h1>

      <div className="grid gap-6 md:grid-cols-2">
        <Card className="md:col-span-1">
          <CardHeader>
            <CardTitle>Search Property Records</CardTitle>
            <CardDescription>
              Search for property records by plot number, owner name, or registration number
            </CardDescription>
          </CardHeader>
          <CardContent>
            <LegalSearchForm />
          </CardContent>
        </Card>

        <Card className="md:col-span-1">
          <CardHeader>
            <CardTitle>Recent Searches</CardTitle>
            <CardDescription>Your recent search history</CardDescription>
          </CardHeader>
          <CardContent>
            <SearchHistory />
          </CardContent>
        </Card>
      </div>
    </div>
  )
}

