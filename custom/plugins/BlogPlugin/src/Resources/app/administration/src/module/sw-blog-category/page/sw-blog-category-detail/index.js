import template from "./sw-blog-category-detail.html.twig";

const { Mixin } = Shopware;
const { Criteria } = Shopware.Data;

export default {
  template,
  inject: ["repositoryFactory"],
  mixins: [Mixin.getByName("notification")],

  data() {
    return {
      blogCategory: null,
      repository: null,
      isLoading: false,
      processSuccess: false,
    };
  },
  props: {
    blogCategoryId: {
      type: String,
      required: false,
      default: null,
    },
  },
  metaInfo() {
    return {
      title: this.$createTitle(),
    };
  },
  watch: {
    blogCategoryId() {
      this.createdComponent();
    },
  },
  created() {
    this.createComponent();
  },
  methods: {
    createComponent() {
      this.repository = this.repositoryFactory.create("blog_category");
      if (this.blogCategoryId) {
        this.getCategory();
        return;
      }
      this.blogCategory = this.repository.create();
      Shopware.State.commit("context/resetLanguageToDefault");
    },
    abortOnLanguageChange() {
      return this.blogRepository.hasChanges(this.blog);
    },

    saveOnLanguageChange() {
      return this.onClickSave();
    },

    onChangeLanguage(languageId) {
      this.isLoading = true;
      Shopware.State.commit("context/setApiLanguageId", languageId);
      this.getCategory();
    },
    getCategory() {
      this.repository
        .get(this.$route.params.id, Shopware.Context.api)
        .then((entity) => {
          this.blogCategory = entity;
        });
    },
    onClickSave() {
      this.isLoading = true;
      this.repository
        .save(this.blogCategory, Shopware.Context.api)
        .then(() => {
          this.isLoading = false;
          this.processSuccess = true;
          this.createNotificationSuccess({
            title: this.$tc("sw-blog-category.detail.titleSaveSuccess"),
            message: this.$tc("sw-blog-category.detail.messageSaveSuccess", 0, {
              name: this.blogCategory.name,
            }),
          });
          if (this.blogCategoryId === null) {
            this.$router.push({
              name: "sw.blog.category.detail",
              params: { id: this.blogCategory.id },
            });
            return;
          }
          this.getCategory();
        })
        .catch((exception) => {
          this.isLoading = false;
          this.createNotificationError({
            title: this.$tc("sw-blog-category.general.somethingWentWrong"),
            message: exception,
          });
        });
    },
    saveFinish() {
      this.processSuccess = false;
    },
  },
};
