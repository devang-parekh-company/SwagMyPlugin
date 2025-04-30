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
      this.repository = this.repositoryFactory.create("blog");
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
          routerLink: "sw.blog.detail",
          allowResize: true,
          primary: true,
          inlineEdit: "string",
        },
        {
          property: "description",
          label: "Description",
          inlineEdit: "string",
          allowResize: true,
        },
        {
          property: "active",
          label: "Active",
          inlineEdit: "boolean",
          allowResize: true,
        },
        {
          property: "release_date",
          label: "Release Date",
          inlineEdit: "string",
          allowResize: true,
        },
      ];
    },
  },
};
