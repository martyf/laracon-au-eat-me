<template>

    <div>
        <v-select
            ref="input"
            :input-id="fieldId"
            class="flex-1"
            append-to-body
            :calculate-position="positionOptions"
            :name="name"
            :clearable="config.clearable"
            :disabled="config.disabled || isReadOnly || (config.multiple && limitReached)"
            :options="options"
            :placeholder="__(config.placeholder)"
            :searchable="config.searchable || config.taggable"
            :taggable="config.taggable"
            :push-tags="config.push_tags"
            :multiple="config.multiple"
            :reset-on-options-change="resetOnOptionsChange"
            :close-on-select="true"
            :value="selectedOptions"
            :create-option="(value) => ({ value, label: value })"
            @input="vueSelectUpdated"
            @focus="$emit('focus')"
            @search:focus="$emit('focus')"
            @search:blur="$emit('blur')">
            <template #option="{ label }">
                <div v-if="config.label_html" v-html="label"></div>
                <template v-else v-text="label"></template>
            </template>
            <template #selected-option="{ label }">
                <div v-if="config.label_html" v-html="label"></div>
                <template v-else v-text="label"></template>
            </template>
            <template #no-options>
                <div class="text-sm text-gray-700 text-left py-2 px-4" v-text="__('No options to choose from.')" />
            </template>
        </v-select>
    </div>

</template>

<script>
export default {

    mixins: [Fieldtype],

    data() {
        return {
            //
        };
    },

    computed: {
        selectedOptions() {
            let selections = this.value || [];
            if (typeof selections === 'string' || typeof selections === 'number') {
                selections = [selections];
            }
            return selections.map(value => {
                return _.findWhere(this.options, {value}) || { value, label: value };
            });
        },

        options() {
            return this.normalizeInputOptions(this.meta.routes);
        },
    },

    methods: {
        normalizeInputOptions(options) {
            return _.map(options, (value, key) => {
                return {
                    'value': Array.isArray(options) ? value : key,
                    'label': __(value) || key
                };
            });
        },

        focus() {
            this.$refs.input.focus();
        },

        vueSelectUpdated(value) {
                if (value) {
                    this.update(value.value)
                } else {
                    this.update(null);
                }
        },
    }

};
</script>
