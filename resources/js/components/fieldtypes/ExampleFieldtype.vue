<template>
    <div class="example-fieldtype-container">


        <div>
            <div class="flex">

                <button @mouseleave="hover=null"
                        @mouseover="doHover(1)"
                        @click.prevent="update(1)">
                    <Donut
                        :class="{ 'grayscale opacity-50' : (hover && hover < 1) || (!hover && value < 1), 'grayscale-0 opacity-100' : hover >= 1 }"
                        class="w-12 h-12 transition-all hover-grayscale-0"
                    />
                </button>
                <button @mouseleave="hover=null"
                        @mouseover="doHover(2)"
                        @click.prevent="update(2)">
                    <Donut
                        :class="{ 'grayscale opacity-50' : (hover && hover < 2) || (!hover && value < 2), 'grayscale-0 opacity-100' : hover >= 2 }"
                        class="w-12 h-12 transition-all hover-grayscale-0"
                    />
                </button>
                <button @mouseleave="hover=null"
                        @mouseover="doHover(3)"
                        @click.prevent="update(3)">
                    <Donut
                        :class="{ 'grayscale opacity-50' : (hover && hover < 3) || (!hover && value < 3), 'grayscale-0 opacity-100' : hover >= 3 }"
                        class="w-12 h-12 transition-all hover-grayscale-0"
                    />
                </button>
                <button @mouseleave="hover=null"
                        @mouseover="doHover(4)"
                        @click.prevent="update(4)">
                    <Donut
                        :class="{ 'grayscale opacity-50' : (hover && hover < 4) || (!hover && value < 4), 'grayscale-0 opacity-100' : hover >= 4 }"
                        class="w-12 h-12 transition-all hover-grayscale-0"
                    />
                </button>
                <button @mouseleave="hover=null"
                        @mouseover="doHover(5)"
                        @click.prevent="update(5)">
                    <Donut
                        :class="{ 'grayscale opacity-50' : (hover && hover < 5) || (!hover && value < 5), 'grayscale-0 opacity-100' : hover >= 5 }"
                        class="w-12 h-12 transition-all hover-grayscale-0"
                    />
                </button>
            </div>
        </div>

    </div>
</template>

<script>
// Learn more at https://statamic.dev/extending/fieldtypes/
import Donut from "./Donut.vue";

export default {
    components: {Donut},
    mixins: [Fieldtype],
    data: function () {
        return {
            hover: null
        }
    },
    methods: {
        doHover(value) {
            this.hover = value;
        }
    }
};
</script>
<style>
.grayscale {
    filter: grayscale(100%) !important;
}

.opacity-100 {
    opacity: 1 !important;
}

.grayscale-0, .hover-grayscale-0:hover {
    filter: grayscale(0) !important;
}
</style>
