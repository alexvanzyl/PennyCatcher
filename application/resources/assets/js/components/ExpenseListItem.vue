<template>
  <div>
    <b-list-group-item class="list-group-item d-flex flex-column justify-content-between align-items-center p-0 mb-4">
      <div class="bg-dark text-light text-center w-100 p-2 mb-3">{{ parseDate(item.created_at) }}</div>
      <div class="mb-3">
        {{ item.category | capitalize }}<span v-if="item.subcategory">: {{ item.subcategory }}</span>
      </div>
      <div class="mb-3">
        <b-badge variant="primary" pill>&euro; {{ item.budget }}</b-badge>
        <b-badge variant="danger" pill v-if="isOverBudget">&euro; {{ item.actual }}</b-badge>
        <b-badge variant="success" pill v-else>&euro; {{ item.actual }}</b-badge>
      </div>
      <b-button-group class="w-100">
        <b-button class="rounded-0 w-50" variant="primary"><i class="fas fa-edit"></i></b-button>
        <b-button class="rounded-0 w-50" variant="danger"><i class="fas fa-trash"></i></b-button>
      </b-button-group>
    </b-list-group-item>
  </div>
</template>

<script>
export default {
  name: 'expense-list-item',
  props: ['item'],
  methods: {
    parseDate(datetime) {
      return moment(datetime).format('Do MMM YYYY')
    }
  },
  computed: {
    isOverBudget() {
      return this.item.budget < this.item.actual
    }
  }
}
</script>

<style>
</style>
