![Alt text](public/cover.svg)

# Gena
[![Deploy Astro site to Pages](https://github.com/bethropolis/gena/actions/workflows/astro.yml/badge.svg)](https://github.com/bethropolis/gena/actions/workflows/astro.yml)

An astro template for writing docs fast using markdown.

# Installation

### cloning repository
you'll have to first clone the repository.

```
git clone https://github.com/bethropolis/gena.git
```
<br/>

### installing 
you'll then install all the projects dependancies.<br/>
you can use npm, yarn pnpm e.t.c

```
npm install
```
<br/>

### developing
you'll have to run the development server for easy development.

```
npm run dev
```

### configuring the sidebar

the left sidebar is configuration is on the `src/content.ts` file. <br/>
edit the file in order to change the content of the sidebar.

```ts
// src/content.ts
export const sidebarStructure = [
  {
    label: "Getting Started",
    children: [
      {
        label: "introduction",
        path: "./docs/introduction",
      },
      {
        label: "installation",
        path: "./docs/installation",
      },
    ],
  }
];
```
<br/>
configuring the right sidebar happens in the markdown/mdx file in the `content` folder.

example `content/docs/introduction.mdx`.


```m
---
title: "Introduction"
outline: ["getting-started", "installation"]
---

rest of the markdown...
```
<br/>

### adding content

To add more content to the template, just add more `markdown\mdx` files to the `content/docs` directory.<br/> 
The routing is done automatically by
Astro, [read about router here](https://docs.astro.build/core-concepts/routing/).
<br/>


### deployment and build
static files are generated hence your docs can be deployed anywhere you want, [read more here](https://docs.astro.build/guides/deploy/).

to build run:
```
npm run build
```
<br/>

## License
 MIT license (do what you want)