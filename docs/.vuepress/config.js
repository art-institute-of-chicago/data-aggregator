const { description } = require('../../package')

module.exports = {
  base: '/docs/',

  /**
   * Ref：https://v1.vuepress.vuejs.org/config/#title
   */
  title: 'Art Institute of Chicago API',
  /**
   * Ref：https://v1.vuepress.vuejs.org/config/#description
   */
  description: description,

  /**
   * Extra tags to be injected to the page HTML `<head>`
   *
   * ref：https://v1.vuepress.vuejs.org/config/#head
   */
  head: [
    ['meta', { name: 'theme-color', content: '#b50938' }],
    ['meta', { name: 'apple-mobile-web-app-capable', content: 'yes' }],
    ['meta', { name: 'apple-mobile-web-app-status-bar-style', content: 'black' }],
    ['link', { rel: "shortcut icon", type: "image/png", href: "/assets/images/favicon-16.png"}],
    ['link', { rel: "apple-touch-icon-precomposed", href: "/assets/images/favicon-152.png"}],
    ['link', { rel: "apple-touch-icon-precomposed", type: "image/png", sizes: "120x120", href: "/assets/images/favicon-120.png"}],
    ['link', { rel: "apple-touch-icon-precomposed", type: "image/png", sizes: "76x76", href: "/assets/images/favicon-76.png"}]
  ],

  /**
   * Theme configuration, here is the default theme configuration for VuePress.
   *
   * ref：https://v1.vuepress.vuejs.org/theme/default-theme-config.html
   */
  themeConfig: {
    repo: 'art-institute-of-chicago/data-aggregator',
    docsDir: 'docs',
    docsBranch: 'develop',
    sidebar: 'auto',
    logo: '/assets/logo.svg',
    nav: [
      {
        text: 'Tutorials',
        link: '/tutorials/'
      },
      {
        text: 'swagger.json',
        link: 'https://api.artic.edu/api/v1/swagger.json'
      }
    ]
  },

  /**
   * Apply plugins，ref：https://v1.vuepress.vuejs.org/zh/plugin/
   */
  plugins: [
    '@vuepress/plugin-back-to-top',
    '@vuepress/plugin-medium-zoom',
    '@vuepress/search', {
        searchMaxSuggestions: 10
    }
  ],

  /**
   * Configure `markdown-it` extensions.
   *
   * ref : https://v1.vuepress.vuejs.org/guide/markdown.html#advanced-configuration
   */
  markdown: {
    linkify: true,
  }
}
