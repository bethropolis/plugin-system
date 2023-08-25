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
        label: "making a plugin",
        path: "./docs/making-a-plugin",
      },
    ],
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