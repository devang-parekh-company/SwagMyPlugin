import template from "./sw-blog-create.html.twig";

const { Mixin } = Shopware;
const { Criteria } = Shopware.Data;

export default {
  template,
  inject: ["repositoryFactory"],
  mixins: [Mixin.getByName("notification")],

  extends: "sw-blog-detail",
  
  methods: {
    getBlog() {
      this.blog = this.blogRepository.create();
    },
    onClickSave() {
      this.isLoading = true;
      this.blogRepository
        .save(this.blog, Shopware.Context.api)
        .then(() => {
          this.isLoading = false;
          this.$router.push({
            name: "sw.blog.detail",
            params: { id: this.blog.id },
          });
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
  },
};
