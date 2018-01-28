<template>
  <div>
    <b-card header-tag="header" no-body class="border-right-0 border-left-0 border-top-0">
      <div slot="header" class="d-flex justify-content-between align-items-center">
        <h6 class="mb-0 w-25">{{ title | capitalize }}</h6>
        <div>
          <b-badge variant="primary" pill>
            &euro; {{ totalBudgetedFor }}
          </b-badge>

          <b-badge :variant="overUnderBudgetColorClass" pill>
            &euro; {{ totalActuallySpent }}
          </b-badge>
        </div>
        <b-button-group>
          <b-button variant="warning" size="sm" @click="showSubcategories = !showSubcategories">
            <i class="fas fa-eye"></i>
          </b-button>
          <b-button v-b-modal.new-expense-modal variant="info" size="sm">
            <i class="fas fa-plus"></i>
          </b-button>
        </b-button-group>
      </div>

      <b-list-group flush v-show="showSubcategories">
        <budget-subcategory v-for="subcategory in subcategories"
                            :subcategory="subcategory"
                            :key="subcategory.id">
        </budget-subcategory>
      </b-list-group>
    </b-card> 
  </div>
</template>

<script>
import BudgetSubcategory from './BudgetSubcategory.vue'

export default {
  props: {
    title: {
      type: String,
      required: true,
    },
    subcategories: {
      type: Array,
      required: true,
    },
  },
  components: {
    BudgetSubcategory
  },
  data() {
    return {
      showSubcategories: false,
    }
  },
  computed: {
    totalBudgetedFor() {
      return _.sumBy(this.subcategories, 'budget')
    },
    totalActuallySpent() {
      return _.sumBy(this.subcategories, 'actual')
    },
    overUnderBudgetColorClass() {
      return (this.totalBudgetedFor < this.totalActuallySpent) ? 'danger' : 'primary'
    },
  },
}
</script>
