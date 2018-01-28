<template>
  <div>
    <b-card header-tag="header" no-body class="mt-4">
      <div slot="header" class="d-flex justify-content-between align-items-center mb-0">
        <h4 class="mb-0">Expenses</h4>
        <b-button v-b-modal.new-expense-modal variant="info">
          <i class="fas fa-plus"></i>
        </b-button>
      </div>
      <b-list-group flush>
        <expense-list-item v-for="expense in expenses"
                           :key="expense.id"
                           :item="expense">
        </expense-list-item>
      </b-list-group>
    </b-card> 
    <!-- Modal Component -->
    <b-modal id="new-expense-modal" ref="newExpenseModal" hide-footer title="Add expense" >
      <new-expense-form @save-expense="saveExpense(expenseFormData)"></new-expense-form> 
    </b-modal>

  </div>
</template>

<script>
import ExpenseListItem from './ExpenseListItem.vue'
import NewExpenseForm from './NewExpenseForm.vue'

export default {
  name: 'expenses-list',
  components: {
    ExpenseListItem,
    NewExpenseForm,
  },
  data () {
    return {
      expenses: [
        {id: 1, created_at: '2017-12-01 12:00:00', type: 'expense', category: 'car', subcategory: 'petrol', description: 'petrol', budget: 70, actual: 50 },
        {id: 2, created_at: '2017-12-01 12:15:45', type: 'expense', category: 'car', subcategory: 'insurance', description: 'Insurance', budget: 310, actual: 400 },
        {id: 3, created_at: '2017-12-03 12:45:42', type: 'expense', category: 'car', subcategory: 'maintanence', description: 'service', budget: 0, actual: 300 },
      ]
    }
  },
  methods: {
    saveExpense(expenseFormData) {

      this.$refs.newExpenseModal.show()
      let newExpense = {
        id: '4', 
        created_at: moment(),
        type: 'expense',
        actual: expenseFormData.amount,
        category: expenseFormData.category,
        subcategory: expenseFormData.subcategory,
        description: expenseFormData.description,
      }

      this.expenses.push(newExpense)
    }
  }
}
</script>
