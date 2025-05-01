import template from "./sw-blog-list.html.twig";

const { Mixin } = Shopware;
const { Criteria } = Shopware.Data;

export default {
  template,
  inject: ["repositoryFactory"],
  data() {
    return {
      blog: null,
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
      this.repository = this.repositoryFactory.create("blog");
      this.repository
        .search(new Criteria(), Shopware.Context.api)
        .then((result) => {
          this.blog = result;
        });
      this.isLoading = false;
    },

    getColumns() {
      return [
        {
          property: "name",
          label: this.$tc('sw-blog.list.columnName'),
          routerLink: "sw.blog.detail",
          inlineEdit: "string",
          allowResize: true,
          primary: true,
        },
        {
          property: "description",
          label: this.$tc('sw-blog.list.columnDescription'),
          allowResize: true,
          primary: false,
        },
        {
          property: "author",
          label: this.$tc('sw-blog.list.columnAuthor'),
          allowResize: true,
          primary: false,
        },
        {
          property: "active",
          label: this.$tc('sw-blog.list.columnActive'),
          allowResize: true,
          primary: false,
        },
        {
          property: "releaseDate",
          label: this.$tc('sw-blog.list.columnReleaseDate'),
          allowResize: true,
          primary: false,
        },
      ];
    },
  },
};
