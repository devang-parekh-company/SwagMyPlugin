import deDE from "./snippet/de-DE.json";
import enGB from "./snippet/en-GB.json";
const { Module } = Shopware;
Shopware.Component.register("sw-blog-list", () =>
  import("./page/sw-blog-list")
);
Shopware.Component.register("sw-blog-create", () =>
  import("./page/sw-blog-create")
);
Shopware.Component.register("sw-blog-detail", () =>
  import("./page/sw-blog-detail")
);

Module.register("sw-blog", {
  type: "plugin",
  name: "sw-blog.general.mainMenuItemGeneral",
  title: "sw-blog.general.mainMenuItemGeneral",
  description: "sw-blog.general.mainMenuItemGeneral",
  color: "#57D9A3",
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
    create: {
        component: 'sw-blog-create',
        path: 'create',
        name: "sw.blog.create",

        meta: {
            parentPath: 'sw.blog.index',
            privilege: 'blog.creator',
        },
    },
    detail: {
        component: 'sw-blog-detail',
        path: 'detail/:id',
        name: "sw.blog.detail",
        meta: {
            parentPath: 'sw.blog.index',
            privilege: 'blog.viewer',
        },
        props: {
            default(route) {
                return {
                    blogId: route.params.id,
                };
            },
        },
    },
  },
  navigation: [
    {
      path: "sw.blog.index",
      label: "sw-blog.general.mainMenuItemList",
      id: "sw-blog",
      parent: "sw-catalogue",
      color: "#57D9A3",
      position: 60,
    },
  ],
});
