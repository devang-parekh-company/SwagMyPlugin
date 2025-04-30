import deDE from "./snippet/de-DE.json";
import enGB from "./snippet/en-GB.json";
const { Module } = Shopware;
Shopware.Component.register("sw-blog-list", () =>
  import("./page/sw-blog-list")
);

Module.register("sw-blog", {
  type: "plugin",
  name: "Blog",
  title: "Blog",
  description: "Blog test",
  color: "#57D9A3",
  icon: "default-shopping-paper-bag-product",
  snippets: {
    "de-DE": deDE,
    "en-GB": enGB,
  },
  routes: {
    index: {
      component: "sw-blog-list",
      path: "index",
      name: "sw.blog.index",
    },
    // create: {
    //     component: 'sw-blog-detail',
    //     path: 'create',
    //     name: "sw.blog.create",

    //     meta: {
    //         parentPath: 'sw.blog.index',
    //         privilege: 'blog.creator',
    //     },
    // },
    // detail: {
    //     component: 'sw-blog-detail',
    //     path: 'detail/:id',
    //     meta: {
    //         parentPath: 'sw.blog.index',
    //         privilege: 'blog.viewer',
    //     },
    //     props: {
    //         default(route) {
    //             return {
    //                 blogId: route.params.id,
    //             };
    //         },
    //     },
    // },
  },
  navigation: [
    {
      path: "sw.blog.index",
      label: "Blog",
      id: "sw-blog",
      parent: "sw-catalogue",
      color: "#57D9A3",
      position: 60,
    },
  ],
});
