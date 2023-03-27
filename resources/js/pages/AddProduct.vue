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
      <p class="text-center">Please submit required data</p>
    </div>

    <div class="bg-red-200 border-red-500 py-3" v-if="message">
      <p class="text-center" v-text="message"></p>
    </div>

    <div class="pt-5 w-1/3">
      <div>
        <div class="flex items-center">
          <label for="sku" class="w-48"
            >SKU <span class="text-red-600">*</span></label
          >
          <input
            id="sku"
            v-model="form.sku"
            :class="{
              'border-red-500': v$.form.sku.$errors.length,
            }"
            class="border px-3 py-1 w-full"
          />
        </div>
        <div v-for="{ $uid, $message } of v$.form.sku.$errors" :key="$uid">
          <div class="text-red-600">{{ $message }}</div>
        </div>
      </div>

      <div class="mt-5">
        <div class="flex items-center">
          <label for="name" class="w-48"
            >Name <span class="text-red-600">*</span></label
          >
          <input
            id="name"
            v-model="form.name"
            :class="{
              'border-red-500': v$.form.name.$errors.length,
            }"
            class="border px-3 py-1 w-full"
          />
        </div>
        <div v-for="{ $uid, $message } of v$.form.name.$errors" :key="$uid">
          <div class="text-red-600">{{ $message }}</div>
        </div>
      </div>

      <div class="mt-5">
        <div class="flex items-center">
          <label for="price" class="w-48"
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
            class="border px-3 py-1 w-full"
          />
        </div>
        <div v-for="{ $uid, $message } of v$.form.price.$errors" :key="$uid">
          <div class="text-red-600">{{ $message }}</div>
        </div>
      </div>

      <div class="mt-5">
        <div class="flex items-center">
          <label for="type" class="w-48"
            >Type switcher <span class="text-red-600">*</span></label
          >
          <select
            id="productType"
            v-model="form.type"
            :class="{
              'border-red-500': v$.form.type.$errors.length,
            }"
            class="border px-3 py-1 w-full"
            placeholder="select"
          >
            <option value="" disabled selected>Select product type</option>
            <option id="DVD" value="DVD">DVD</option>
            <option id="Book" value="Book">Book</option>
            <option id="Furniture" value="Furniture">Furniture</option>
          </select>
        </div>
        <div v-for="{ $uid, $message } of v$.form.type.$errors" :key="$uid">
          <div class="text-red-600">{{ $message }}</div>
        </div>
      </div>

      <div v-if="form.type == 'DVD'" class="mt-5">
        <div class="flex items-center">
          <label for="size" class="w-48"
            >Size (MB) <span class="text-red-600">*</span></label
          >
          <input
            type="number"
            min="0"
            step="1"
            id="size"
            v-model="form.size"
            :class="{
              'border-red-500': v$.form.size.$errors.length,
            }"
            class="border px-3 py-1 w-full"
          />
        </div>
        <p class="text-slate-800 text-sm">Please provide size in MB</p>
        <div v-for="{ $uid, $message } of v$.form.size.$errors" :key="$uid">
          <div class="text-red-600">{{ $message }}</div>
        </div>
      </div>
      <div v-else-if="form.type == 'Book'" class="mt-5">
        <div class="flex items-center">
          <label for="weight" class="w-48"
            >Weight (KG) <span class="text-red-600">*</span></label
          >
          <input
            type="number"
            min="0"
            step="1"
            id="weight"
            v-model="form.weight"
            :class="{
              'border-red-500': v$.form.weight.$errors.length,
            }"
            class="border px-3 py-1 w-full"
          />
        </div>
        <p class="text-slate-800 text-sm">Please provide weight in KG</p>
        <div v-for="{ $uid, $message } of v$.form.weight.$errors" :key="$uid">
          <div class="text-red-600">{{ $message }}</div>
        </div>
      </div>
      <div v-else-if="form.type == 'Furniture'" class="mt-5">
        <div class="flex items-center">
          <label for="height" class="w-48"
            >Height (CM) <span class="text-red-600">*</span></label
          >
          <input
            type="number"
            min="0"
            step="1"
            id="height"
            v-model="form.height"
            :class="{
              'border-red-500': v$.form.height.$errors.length,
            }"
            class="border px-3 py-1 w-full"
          />
        </div>
        <div v-for="{ $uid, $message } of v$.form.height.$errors" :key="$uid">
          <div class="text-red-600">{{ $message }}</div>
        </div>

        <div class="flex items-center mt-5">
          <label for="width" class="w-48"
            >Width (CM) <span class="text-red-600">*</span></label
          >
          <input
            type="number"
            min="0"
            step="1"
            id="width"
            v-model="form.width"
            :class="{
              'border-red-500': v$.form.width.$errors.length,
            }"
            class="border px-3 py-1 w-full"
          />
        </div>
        <div v-for="{ $uid, $message } of v$.form.width.$errors" :key="$uid">
          <div class="text-red-600">{{ $message }}</div>
        </div>

        <div class="flex items-center mt-5">
          <label for="length" class="w-48"
            >Length (CM) <span class="text-red-600">*</span></label
          >
          <input
            type="number"
            min="0"
            step="1"
            id="length"
            v-model="form.length"
            :class="{
              'border-red-500': v$.form.length.$errors.length,
            }"
            class="border px-3 py-1 w-full"
          />
        </div>
        <div v-for="{ $uid, $message } of v$.form.length.$errors" :key="$uid">
          <div class="text-red-600">{{ $message }}</div>
        </div>

        <p class="text-slate-800 text-sm">
          Please provide dimensions, height x width x length in CM
        </p>
      </div>
    </div>
  </form>
</template>

<script>
import { useVuelidate } from "@vuelidate/core";
import {
  required,
  maxLength,
  decimal,
  requiredIf,
} from "@vuelidate/validators";
import { helpers } from "@vuelidate/validators";

export default {
  setup() {
    return { v$: useVuelidate() };
  },
  data() {
    return {
      message: null,
      form: {
        sku: null,
        name: null,
        price: null,
        type: null,
        size: null,
        weight: null,
        height: null,
        width: null,
        length: null,
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
        type: {
          $autoDirty: true,
          required,
        },
        size: {
          $autoDirty: true,
          decimal,
          requiredIf: requiredIf(this.form.type == "DVD"),
        },
        weight: {
          $autoDirty: true,
          decimal,
          requiredIf: requiredIf(this.form.type == "Book"),
        },
        height: {
          $autoDirty: true,
          decimal,
          requiredIf: requiredIf(this.form.type == "Furniture"),
        },
        width: {
          $autoDirty: true,
          decimal,
          requiredIf: requiredIf(this.form.type == "Furniture"),
        },
        length: {
          $autoDirty: true,
          decimal,
          requiredIf: requiredIf(this.form.type == "Furniture"),
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
      if (!isFormCorrect) return;

      this.$axios
        .post("products", this.form)
        .then(() => this.$router.push({ name: "Products" }))
        .catch(({ message }) => (this.message = message));
    },
  },
};
</script>
