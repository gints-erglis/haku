# Haku - clean Drupal 11 theme starter

## Structure
...
## Storybook

To start using a Storybook tool in the theme, navigate to `storybook` folder and run:

```
npx storybook init
```
Edit `.storybook/main.ts` file and change this line

```
stories: ["../src/**/*.mdx", "../src/**/*.stories.@(js|jsx|mjs|ts|tsx)"],
```
to
```
stories: ["../src/**/*.mdx", "../../components/**/*.stories.@(js|jsx|mjs|ts|tsx)"],
```
Run Storybook

```
npm run storybook
```

### How to write a stories?

**Component Story Format (CSF)** - The Standard for Writing Storybook Stories
CSF (Component Story Format) is the official way to write Storybook stories. It is a JavaScript/TypeScript-based format that allows defining UI component examples in a structured, reusable way. It is widely used across different frontend frameworks, including React, Vue, Angular, and Svelte.

[Documentation](https://storybook.js.org/docs/api/csf)