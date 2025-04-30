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
  metaInfo() {
    return {
      title: this.$createTitle(),
    };
  },
  computed: {
    options() {
      return [
        {
          value: "absolute",
          label: "Absolute",
        },
      ];
    },
  },
  created() {
    this.createComponent();
  },
  methods: {
    createComponent() {
      this.repository = this.repositoryFactory.create("blog_category");
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
          this.getCategory();
          this.isLoading = false;
          this.processSuccess = true;
        })
        .catch((exception) => {
            this.isLoading = false;
            this.createNotificationError({
                title: this.$tc('sw-blog-category.detail.errorTitle'),
                message: exception
            });
        });
    },
    saveFinish() {
      this.processSuccess = false;
    },
  },
};
