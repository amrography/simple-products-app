<template>
  <div>
    <div
      class="bg-slate-100 p-5 flex justify-between items-center border-bottom"
    >
      <h1 class="text-2xl">Product List</h1>

      <div class="flex gap-3 content-center">
        <router-link
          :to="{ name: 'AddProduct' }"
          class="bg-green-600 border-green-800 px-5 py-3 text-white"
        >ADD</router-link>

        <button
          @click="massDelete"
          id="delete-product-btn"
          class="bg-red-600 border-red-900 px-5 py-3 text-white"
        >MASS DELETE</button>
      </div>
    </div>

    <div class="grid grid-cols-4 gap-4 mt-5">
      <div
        class="border p-5 w-72 xl:mb-0"
        :class="{
          'border-blue-600': checkboxes[product.id],
        }"
        v-for="product in products"
        :key="product.id"
      >
        <input
          type="checkbox"
          class="delete-checkbox"
          v-model="checkboxes[product.id]"
        />
        <p class="text-center">
          {{ product.sku }}
        </p>
        <p class="text-center">
          {{ product.name }}
        </p>
        <p class="text-center">{{ product.price / 100 }} $</p>

        <p class="text-center" v-text="attribute(product)"></p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      products: [],
      checkboxes: [],
    };
  },
  methods: {
    attribute(product) {
      if (product.attributes?.length < 0) {
        return;
      }

      let attrs = JSON.parse(product.attributes);

      switch (product.type) {
        case "DVD":
          return `Size: ${attrs[0]} MB`;
        case "Book":
          return `Weight: ${attrs[0]} KG`;
        case "Furniture":
          return `Dimensions: ${attrs.join("x")}`;

        default:
          break;
      }
    },
    async massDelete() {
      await this.$axios.post("delete-products", {
        ids: JSON.stringify(Object.keys(this.checkboxes)),
      });

      for (const id in this.checkboxes) {
        let index = this.products.findIndex((p) => p.id == id);
        this.products.splice(index, 1);
      }

      this.checkboxes = [];
    },
  },
  async mounted() {
    const { data } = await this.$axios.get("products");
    this.products = data;
  },
};
</script>
