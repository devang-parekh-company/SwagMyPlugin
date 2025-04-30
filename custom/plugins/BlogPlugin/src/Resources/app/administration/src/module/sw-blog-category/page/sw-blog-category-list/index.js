import template from "./sw-blog-category-list.html.twig";

const { Mixin } = Shopware;
const { Criteria } = Shopware.Data;

export default {
  template,
  inject: ["repositoryFactory"],
  data() {
    return {
      blogCategory: null,
      repository: null,
    };
  },
  metaInfo() {
    return {
      title: this.$createTitle(),
    };
  },
  computed: {
    columns() {
      return this.getColumns();
    },
  },
  created() {
    this.createComponent();
  },
  methods: {
    createComponent() {
      this.repository = this.repositoryFactory.create("blog_category");
      this.repository
        .search(new Criteria(), Shopware.Context.api)
        .then((result) => {
          this.blog = result;
        });
    },

    getColumns() {
      return [
        {
          property: "name",
          label: "Name",
          routerLink: "sw.blog_category.detail",
          allowResize: true,
          primary: true,
          inlineEdit: "string",
        },
      ];
    },
  },
};
