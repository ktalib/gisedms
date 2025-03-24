"use client"

import { useState } from "react"
import { zodResolver } from "@hookform/resolvers/zod"
import { useForm } from "react-hook-form"
import * as z from "zod"
import { Button } from "@/components/ui/button"
import { Form, FormControl, FormDescription, FormField, FormItem, FormLabel, FormMessage } from "@/components/ui/form"
import { Input } from "@/components/ui/input"
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select"
import { toast } from "@/components/ui/use-toast"

const formSchema = z.object({
  searchType: z.string({
    required_error: "Please select a search type",
  }),
  searchQuery: z.string().min(2, {
    message: "Search query must be at least 2 characters.",
  }),
})

export function LegalSearchForm() {
  const [isSearching, setIsSearching] = useState(false)

  const form = useForm<z.infer<typeof formSchema>>({
    resolver: zodResolver(formSchema),
    defaultValues: {
      searchType: "plotNumber",
      searchQuery: "",
    },
  })

  function onSubmit(values: z.infer<typeof formSchema>) {
    setIsSearching(true)

    // Simulate API call
    setTimeout(() => {
      setIsSearching(false)
      toast({
        title: "Search Initiated",
        description: `Searching for ${values.searchQuery} by ${values.searchType}`,
      })
    }, 1500)
  }

  return (
    <Form {...form}>
      <form onSubmit={form.handleSubmit(onSubmit)} className="space-y-6">
        <FormField
          control={form.control}
          name="searchType"
          render={({ field }) => (
            <FormItem>
              <FormLabel>Search Type</FormLabel>
              <Select onValueChange={field.onChange} defaultValue={field.value}>
                <FormControl>
                  <SelectTrigger>
                    <SelectValue placeholder="Select a search type" />
                  </SelectTrigger>
                </FormControl>
                <SelectContent>
                  <SelectItem value="plotNumber">Plot Number</SelectItem>
                  <SelectItem value="ownerName">Owner Name</SelectItem>
                  <SelectItem value="registrationNumber">Registration Number</SelectItem>
                  <SelectItem value="titleNumber">Title Number</SelectItem>
                  <SelectItem value="address">Property Address</SelectItem>
                </SelectContent>
              </Select>
              <FormDescription>Select the type of search you want to perform</FormDescription>
              <FormMessage />
            </FormItem>
          )}
        />

        <FormField
          control={form.control}
          name="searchQuery"
          render={({ field }) => (
            <FormItem>
              <FormLabel>Search Query</FormLabel>
              <FormControl>
                <Input placeholder="Enter search term..." {...field} />
              </FormControl>
              <FormDescription>Enter the search term based on the selected search type</FormDescription>
              <FormMessage />
            </FormItem>
          )}
        />

        <Button type="submit" className="w-full" disabled={isSearching}>
          {isSearching ? "Searching..." : "Search Records"}
        </Button>
      </form>
    </Form>
  )
}

