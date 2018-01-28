<template>
  <div>
    <b-list-group-item>
      <div class="d-flex justify-content-between">
        <div>
          {{ subcategory.subcategory | capitalize }}
        </div>
        <div>
          <b-badge variant="primary" pill>
            &euro; {{ subcategory.budget }}
          </b-badge>

          <b-badge :variant="overUnderBudgetColorClass" pill>
            &euro; {{ subcategory.actual }}
          </b-badge>
        </div>
      </div>
    </b-list-group-item>
  </div>
</template>

<script>
export default {
  props: {
    subcategory: {
      type: Object,
      required: true,
    }
  },
  computed: {
    overUnderBudgetColorClass() {
      return (this.subcategory.budget < this.subcategory.actual) ? 'danger' : 'primary'
    },
  },
}
</script>
