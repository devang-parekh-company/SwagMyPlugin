import type * as PayPal from 'SwagPayPal/types';
import template from './swag-paypal-express.html.twig';

const { Criteria } = Shopware.Data;

/**
 * @deprecated tag:v10.0.0 - Will be replaced by `swag-paypal-settings-storefront`
 */
export default Shopware.Component.wrapComponentConfig({
    template,

    inject: ['acl', 'repositoryFactory'],

    props: {
        actualConfigData: {
            type: Object as PropType<PayPal.SystemConfig>,
            required: true,
            default: () => { return {}; },
        },
        allConfigs: {
            type: Object as PropType<Record<string, PayPal.SystemConfig>>,
            required: true,
        },
        selectedSalesChannelId: {
            type: String,
            required: false,
            default: null,
        },
    },

    data() {
        return {
            doubleOptInConfig: false,
        };
    },

    created() {
        this.fetchSystemConfig();
    },

    computed: {
        buttonColorOptions() {
            return [
                {
                    id: 'blue',
                    name: this.$tc('swag-paypal.settingForm.express.ecsButtonColor.options.blue'),
                },
                {
                    id: 'black',
                    name: this.$tc('swag-paypal.settingForm.express.ecsButtonColor.options.black'),
                },
                {
                    id: 'gold',
                    name: this.$tc('swag-paypal.settingForm.express.ecsButtonColor.options.gold'),
                },
                {
                    id: 'silver',
                    name: this.$tc('swag-paypal.settingForm.express.ecsButtonColor.options.silver'),
                },
                {
                    id: 'white',
                    name: this.$tc('swag-paypal.settingForm.express.ecsButtonColor.options.white'),
                },
            ];
        },
        buttonShapeOptions() {
            return [
                {
                    id: 'sharp',
                    name: this.$tc('swag-paypal.settingForm.express.ecsButtonShape.options.sharp'),
                },
                {
                    id: 'pill',
                    name: this.$tc('swag-paypal.settingForm.express.ecsButtonShape.options.pill'),
                },
                {
                    id: 'rect',
                    name: this.$tc('swag-paypal.settingForm.express.ecsButtonShape.options.rect'),
                },
            ];
        },

        renderSettingsDisabled() {
            return !this.acl.can('swag_paypal.editor') || (
                !this.selectedSalesChannelId
                && !this.actualConfigData['SwagPayPal.settings.ecsDetailEnabled']
                && !this.actualConfigData['SwagPayPal.settings.ecsCartEnabled']
                && !this.actualConfigData['SwagPayPal.settings.ecsOffCanvasEnabled']
                && !this.actualConfigData['SwagPayPal.settings.ecsLoginEnabled']
                && !this.actualConfigData['SwagPayPal.settings.ecsListingEnabled']
            );
        },

        systemConfigRepository(): TRepository<'system_config'> {
            return this.repositoryFactory.create('system_config');
        },

        systemConfigCriteria(): TCriteria {
            const criteria = new Criteria();

            criteria.addFilter(Criteria.equals('configurationKey', 'core.loginRegistration.doubleOptInGuestOrder'));
            criteria.addFilter(Criteria.equals('configurationValue', 'true'));

            return criteria;
        },
    },

    methods: {
        /**
         * @deprecated tag:v10.0.0 - Will be removed and is replaced by swag-paypal-inherit-wrapper
         */
        checkTextFieldInheritance(value: unknown): boolean {
            if (typeof value !== 'string') {
                return true;
            }

            return value.length <= 0;
        },

        /**
         * @deprecated tag:v10.0.0 - Will be removed and is replaced by swag-paypal-inherit-wrapper
         */
        checkBoolFieldInheritance(value: unknown): boolean {
            return typeof value !== 'boolean';
        },

        async fetchSystemConfig(): Promise<void> {
            const response = await this.systemConfigRepository.search(this.systemConfigCriteria);

            this.doubleOptInConfig = (response?.total != null && response.total > 0);
        },

        preventSave(mode: boolean) {
            this.$emit('preventSave', mode);
        },
    },
});
