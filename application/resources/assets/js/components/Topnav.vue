<template>
<b-navbar toggleable="md" type="dark" variant="success">
  <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>
  <b-navbar-brand href="#">Penny Catcher</b-navbar-brand>
  <b-collapse is-nav id="nav_collapse">
    <b-navbar-nav>
      <b-nav-item href="/">Overview</b-nav-item>
      <b-nav-item href="transactions">Transactions</b-nav-item>
    </b-navbar-nav>
    <!-- Right aligned nav items -->
    <b-navbar-nav class="ml-auto">
      <b-nav-item right>
        <b-button variant="warning">
          <i class="fas fa-sign-out-alt"></i>
        </b-button>
      </b-nav-item>
    </b-navbar-nav>
  </b-collapse>
</b-navbar>
</template>

<script>
export default {
  name: 'topnav',
}
</script>
