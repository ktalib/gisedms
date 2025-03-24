"use client"

import Link from "next/link"
import { usePathname } from "next/navigation"
import { LayoutDashboard, Map, FileText, Search, Receipt, Users, FileStack, Settings, CreditCard } from "lucide-react"
import { cn } from "@/lib/utils"
import { Button } from "@/components/ui/button"

const sidebarLinks = [
  {
    title: "Dashboard",
    href: "/dashboard",
    icon: LayoutDashboard,
  },
  {
    title: "Plot Allocation",
    href: "/dashboard/plot-allocation",
    icon: Map,
  },
  {
    title: "Title Recertification",
    href: "/dashboard/title-recertification",
    icon: FileText,
  },
  {
    title: "Instrument Registration",
    href: "/dashboard/instrument-registration",
    icon: FileStack,
  },
  {
    title: "Legal Search",
    href: "/dashboard/legal-search",
    icon: Search,
  },
  {
    title: "Billing",
    href: "/dashboard/billing",
    icon: Receipt,
  },
  {
    title: "Revenue Collection",
    href: "/dashboard/revenue",
    icon: CreditCard,
  },
  {
    title: "Customers",
    href: "/dashboard/customers",
    icon: Users,
  },
  {
    title: "Administration",
    href: "/dashboard/admin",
    icon: Settings,
  },
]

export function Sidebar() {
  const pathname = usePathname()

  return (
    <div className="hidden border-r bg-background md:block md:w-64">
      <div className="flex h-full flex-col gap-2 p-4">
        <div className="flex h-14 items-center border-b px-4 font-semibold">Land Registry System</div>
        <div className="flex-1 py-2">
          <nav className="grid gap-1 px-2">
            {sidebarLinks.map((link) => (
              <Button
                key={link.href}
                variant={pathname === link.href ? "secondary" : "ghost"}
                className={cn(
                  "flex h-10 items-center justify-start gap-2 px-4 text-sm font-medium",
                  pathname === link.href ? "bg-secondary text-secondary-foreground" : "text-muted-foreground",
                )}
                asChild
              >
                <Link href={link.href}>
                  <link.icon className="h-5 w-5" />
                  {link.title}
                </Link>
              </Button>
            ))}
          </nav>
        </div>
      </div>
    </div>
  )
}

