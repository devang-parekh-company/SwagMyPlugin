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
      isLoading: false,
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
      this.isLoading = true;
      this.repository = this.repositoryFactory.create("blog_category");
      this.repository
        .search(new Criteria(), Shopware.Context.api)
        .then((result) => {
          this.blogCategory = result;
        });
      this.isLoading = false;
    },

    getColumns() {
      return [
        {
          property: "name",
          label: "sw-blog-category.list.columnName",
          routerLink: "sw.blog.category.detail",
          inlineEdit: "string",
          allowResize: true,
          primary: true,
        },
      ];
    },
  },
};
