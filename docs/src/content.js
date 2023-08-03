// content.ts
export const sidebarStructure = [
  {
    label: "Getting Started",
    path: "/getting-started",
  },
  {
    label: "Usage",
    path: "/usage",
  },
  {
    label: "Advanced",
    path: "/advanced",
    children: [
      {
        label: "Option 1",
        path: "/advanced/option-1",
      },
      {
        label: "Option 2",
        path: "/advanced/option-2",
      },
    ],
  },
];
