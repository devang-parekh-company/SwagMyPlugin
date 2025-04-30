import template from "./sw-blog-category-create.html.twig";

const { Mixin } = Shopware;
const { Criteria } = Shopware.Data;

export default {
  template,
  inject: ["repositoryFactory"],
  mixins: [Mixin.getByName("notification")],

  extends: "sw-blog-category-detail",

  methods: {
    getCategory() {
      this.blogCategory = this.repository.create();
    },

    onClickSave() {
      this.isLoading = true;
      this.repository
        .save(this.blogCategory, Shopware.Context.api)
        .then(() => {
          this.isLoading = false;
          this.$router.push({
            name: "sw.blog.category.detail",
            params: { id: this.blogCategory.id },
          });
        })
        .catch((exception) => {
          this.isLoading = false;
          this.createNotificationError({
            title: this.$tc("sw-blog-category.detail.erroTitle"),
            message: exception,
          });
        });
    },
  },
};
