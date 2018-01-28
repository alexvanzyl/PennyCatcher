<template>
  <div>
    <b-form @submit="saveExpense()">
      <b-form-group label="Select a date:" label-for="expense-date">
        <flat-pickr
                id="expense-date"
                v-model="form.date"
                :config="datePickerConfig"                                
                :required="true"                
                class="form-control" 
                name="date">
        </flat-pickr>
      </b-form-group>
      <b-form-group label="Category:"
                    label-for="category">
        <b-form-input id="category"
                      type="text"
                      v-model="form.category"
                      required
                      placeholder="category i.e car, utilities, taxes">
        </b-form-input>
      </b-form-group>
      <b-form-group label="Subcategory (Optional):"
                    label-for="sub-category">
        <b-form-input id="sub-category"
                      type="text"
                      v-model="form.subcategory"
                      placeholder="Subcategory i.e gas, electricity, income tax">
        </b-form-input>
      </b-form-group>
      <b-form-group label="Description (Optional):"
                    label-for="description">
        <b-form-textarea id="description"
                      type="text"
                      v-model="form.description"
                      placeholder="Here you can add any addtional information">
        </b-form-textarea>
      </b-form-group>
      <b-form-group label="Amount:"
                    label-for="amount">
        <b-form-input id="amount"
                      type="text"
                      v-model="form.amount"
                      placeholder="amount">
        </b-form-input>
      </b-form-group>
      <b-button type="submit" variant="primary" block>Submit</b-button>
    </b-form> 
  </div>
</template>

<script>
export default {
  name: 'new-expense-form',
  data () {
    return {
      form: {
        date: new Date(),
        category: '',
        subcategory: '',
        description: '',
        amount: 0,
      },
      datePickerConfig: {
        altFormat: 'M	j, Y',
        altInput: true,
      },
    }
  },
  methods: {
    saveExpense() {
      this.$emit('save-expense', this.form);
    }
  }
}
</script>
