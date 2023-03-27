<template>
  <form id="product_form" @submit.prevent="submit">
    <div
      class="bg-slate-100 p-5 flex justify-between items-center border-bottom"
    >
      <h1 class="text-2xl">Product Add</h1>

      <div class="flex gap-3 content-center">
        <button
          :disabled="v$.form.$invalid"
          type="submit"
          :class="{
            'bg-green-600 border-green-800 px-5 py-3 text-white': true,
            'opacity-50 cursor-not-allowed': v$.form.$invalid,
          }"
        >
          Save
        </button>

        <router-link
          :to="{ name: 'Products' }"
          class="bg-red-600 border-red-900 px-5 py-3 text-white"
        >
          Cancel
        </router-link>
      </div>
    </div>

    <div class="bg-red-200 border-red-500 py-3" v-if="v$.form.$error">
      <p class="text-center">Please, submit required data</p>
    </div>

    <div class="pt-5">
      <div>
        <div class="flex items-center">
          <label for="sku" class="w-20"
            >SKU <span class="text-red-600">*</span></label
          >
          <input
            id="sku"
            v-model="form.sku"
            :class="{
              'border-red-500': v$.form.sku.$errors.length,
            }"
            class="border px-3 py-1"
          />
        </div>
        <div v-for="{ $uid, $message } of v$.form.sku.$errors" :key="$uid">
          <div class="text-red-600">{{ $message }}</div>
        </div>
      </div>

      <div class="mt-5">
        <div class="flex items-center">
          <label for="name" class="w-20"
            >Name <span class="text-red-600">*</span></label
          >
          <input
            id="name"
            v-model="form.name"
            :class="{
              'border-red-500': v$.form.name.$errors.length,
            }"
            class="border px-3 py-1"
          />
        </div>
        <div v-for="{ $uid, $message } of v$.form.name.$errors" :key="$uid">
          <div class="text-red-600">{{ $message }}</div>
        </div>
      </div>

      <div class="mt-5">
        <div class="flex items-center">
          <label for="price" class="w-20"
            >Price ($) <span class="text-red-600">*</span></label
          >
          <input
            type="number"
            min="0"
            step="0.01"
            id="price"
            v-model="form.price"
            :class="{
              'border-red-500': v$.form.price.$errors.length,
            }"
            class="border px-3 py-1"
          />
        </div>
        <div v-for="{ $uid, $message } of v$.form.price.$errors" :key="$uid">
          <div class="text-red-600">{{ $message }}</div>
        </div>
      </div>
    </div>
  </form>
</template>

<script>
import { useVuelidate } from "@vuelidate/core";
import { required, maxLength, decimal } from "@vuelidate/validators";
import { helpers } from "@vuelidate/validators";

export default {
  setup() {
    return { v$: useVuelidate() };
  },
  data() {
    return {
      form: {
        sku: null,
        name: null,
        price: null,
      },
    };
  },
  validations() {
    return {
      form: {
        name: {
          $autoDirty: true,
          required,
          maxLength: maxLength(255),
        },
        price: {
          $autoDirty: true,
          required,
          decimal,
        },
        sku: {
          $autoDirty: true,
          required,
          maxLength: maxLength(255),
          unique: helpers.withMessage(
            "SKU already exists",
            helpers.withAsync(async (sku) => {
              if (!sku || sku.length < 1) {
                return true;
              }

              const { data } = await this.$axios.post(
                "/products/validate-sku",
                {
                  sku,
                }
              );

              return data.count < 1;
            })
          ),
        },
      },
    };
  },
  methods: {
    async submit() {
      const isFormCorrect = await this.v$.$validate();
      console.log(isFormCorrect);
      if (!isFormCorrect) return;
    },
  },
};
</script>
