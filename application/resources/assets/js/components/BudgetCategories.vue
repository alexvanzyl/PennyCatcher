<template>
  <div>
    <b-card header-tag="header" no-body class="mt-4">
      <div slot="header" class="d-flex justify-content-between align-items-center mb-0">
        <h4 class="mb-0">Planned {{ type }}</h4>
        <b-button v-b-modal.new-expense-modal variant="info">
          <i class="fas fa-plus"></i>
        </b-button>
      </div>
      <budget-category v-for="(value, key) in items"
                        :title="key"
                        :subcategories="value"
                        :key="key">
      </budget-category>
    </b-card> 
  </div>
</template>

<script>
import BudgetCategory from './BudgetCategory.vue'

export default {
  name: 'budget-categories',
  props: {
    type: {
      type: String,
      required: true,
    }, 
  },
  components: {
    BudgetCategory
  },
  data() {
    return {
      items: [],
    }
  },
  created() {
    // This will actually be an Ajax call fetching expense/income main and subcategories
    let items = [
      {id: 1, created_at: '2017-12-01 12:00:00', type: 'expense', category: 'car', subcategory: 'petrol', description: 'petrol', budget: 70, actual: 50 },
      {id: 2, created_at: '2017-12-01 12:15:45', type: 'expense', category: 'car', subcategory: 'insurance', description: 'Insurance', budget: 310, actual: 400 },
      {id: 3, created_at: '2017-12-03 12:45:42', type: 'expense', category: 'car', subcategory: 'maintanence', description: 'service', budget: 300, actual: 300 },
      {id: 4, created_at: '2017-12-23 12:00:00', type: 'expense', category: 'utilities', subcategory: 'mobile', description: 'cabelnet', budget: 70, actual: 50 },
      {id: 5, created_at: '2017-12-26 12:15:45', type: 'expense', category: 'utilities', subcategory: 'internet', description: 'cablenet', budget: 200, actual: 400 },
    ]
    
    this.items = _.groupBy(items, 'category')
  },
}
</script>
