// content.ts
export const sidebarStructure = [
  {
    label: "Getting Started",
    children: [
      {
        label: "introduction",
        path: "./docs/introduction",
      },
      {
        label: "developing plugins",
        path: "./docs/making-a-plugin",
      },
      {
        label: "running a plugin",
        path: "./docs/running-a-plugin",
      },
      {
        label: "getting plugin info",
        path: "./docs/getting-plugin-info",
      }
    ],
  },
  {
    label: "APIs",
    children: [
      {
        label: "System",
        path: "./docs/api/system",
      },
      {
        label: "Plugin",
        path: "./docs/api/plugin",
      },
      {
        label: "manager",
        path: "./docs/api/manager",
      },
      {
        label: "Lifecycle",
        path: "./docs/api/lifecycle",
      },
      {
        label: "Info",
        path: "./docs/api/info",
      }
    ]
  },
  {
    label: "other",
    children: [
      {
        label: "project structure",
        path: "./docs/structure",
      },
      {
        label: "showcase",
        path: "./docs/showcase",
      },
    ],
  },
];

export const base = "/plugin-system";

export const docsDir = "docs";

export const githubUrl = "https://github.com/bethropolis/plugin-system";