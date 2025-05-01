import template from "./sw-blog-detail.html.twig";

const { Mixin } = Shopware;
const { Criteria } = Shopware.Data;

export default {
  template,
  inject: ["repositoryFactory"],
  mixins: [Mixin.getByName("notification")],

  data() {
    return {
      blog: null,
      blogCategory: null,
      product: null,
      blogRepository: null,
      blogCategoryRepository: null,
      productRepository: null,
      isLoading: false,
      processSuccess: false,
      blogCategoryOptions: null,
    };
  },
  metaInfo() {
    return {
      title: this.$createTitle(),
    };
  },
  created() {
    this.createdComponent();
  },
  methods: {
    createdComponent() {
      this.blogRepository = this.repositoryFactory.create("blog");
      this.blogCategoryRepository = this.repositoryFactory.create("blog_category");
      this.productRepository = this.repositoryFactory.create("product");
      this.getBlog();
      this.getBlogCategory();
      this.getProduct();
    },

    getBlog() {
      const criteria = new Criteria();      
      criteria.addAssociation("blogCategories");
      criteria.addAssociation("products");

      this.blogRepository
        .get(this.$route.params.id, Shopware.Context.api, criteria)
        .then((entity) => {
          this.blog = entity;
        });
    },
    getBlogCategory() {
      this.blogCategoryRepository
        .search(new Criteria(), Shopware.Context.api)
        .then((result) => {
          this.blogCategoryOptions = result;
        });
      },
    getProduct() {
      this.productRepository
        .search(new Criteria(), Shopware.Context.api)
        .then((result) => {
          this.product = result;
        });
      },
    onClickSave() {
      this.isLoading = true;
      this.blogRepository
        .save(this.blog, Shopware.Context.api)
        .then(() => {
          this.getBlog();
          this.isLoading = false;
          this.processSuccess = true;
          this.createNotificationSuccess({
            title: this.$tc("sw-blog.detail.titleSaveSuccess"),
            message: this.$tc("sw-blog.detail.messageSaveSuccess", 0, { name: this.blog.name }),
          });
        })
        .catch((exception) => {
          this.isLoading = false;
          this.createNotificationError({
            title: "sw-blog.general.somethingWentWrong",
            message: exception,
          });
        });
    },
    saveFinish() {
      this.processSuccess = false;
    },
  },
};
