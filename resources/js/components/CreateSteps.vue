<template>
  <form-wizard @on-complete="onComplete"
               title=""
               subtitle="">
    <tab-content title="Personal">
      <el-form ref="form" :model="form" label-width="120px">
        <el-row>
          <el-col :span="8">
            <el-form-item label="First name">
              <el-input v-model="form.firstname"></el-input>
            </el-form-item>
          </el-col>
          <el-col :span="8">
            <el-form-item label="Last name">
              <el-input v-model="form.lastname"></el-input>
            </el-form-item>
          </el-col>
          <el-col :span="8">
            <el-form-item label="Phone">
              <el-input v-model="form.phone"></el-input>
            </el-form-item>
          </el-col>
        </el-row>
      </el-form>
    </tab-content>
    <tab-content title="Address">
      <el-form ref="form" :model="form" label-width="120px">
        <el-row>
          <el-col :span="8">
            <el-form-item label="Address">
              <el-input v-model="form.address"></el-input>
            </el-form-item>
          </el-col>
          <el-col :span="4">
            <el-form-item label="Number">
              <el-input v-model="form.address_number"></el-input>
            </el-form-item>
          </el-col>
          <el-col :span="4">
            <el-form-item label="Zipcode">
              <el-input v-model="form.zipcode"></el-input>
            </el-form-item>
          </el-col>
          <el-col :span="8">
            <el-form-item label="City">
              <el-input v-model="form.city"></el-input>
            </el-form-item>
          </el-col>
        </el-row>
      </el-form>
    </tab-content>
    <tab-content title="Payment">
      <el-form ref="form" :model="form" label-width="120px">
        <el-row>
          <el-col :span="12">
            <el-form-item label="Account owner">
              <el-input v-model="form.account_owner"></el-input>
            </el-form-item>
          </el-col>
          <el-col :span="12">
            <el-form-item label="IBAN">
              <el-input v-model="form.iban"></el-input>
            </el-form-item>
          </el-col>
        </el-row>
      </el-form>
    </tab-content>
 </form-wizard>
</template>

<script>
  export default {
    methods: {
      onComplete: function() {
        this.$alert('The user was created successfully. The Payment id is ...', 'User created', {
          confirmButtonText: 'OK',
        });
      }
    },
    data() {
      return {
        form: {
          // firstname: 'Gustavo',
          // lastname: 'Barbosa Gama',
          // phone: '55 35 991455747',
          // address: 'Rua Imirim',
          // address_number: '70',
          // zipcode: '37701-167',
          // city: 'Poços de Caldas',
          // account_owner: 'Gustavo Gama',
          // iban: 'BR6060746948001000010000000C1',
          firstname: '',
          lastname: '',
          phone: '',
          address: '',
          address_number: '',
          zipcode: '',
          city: '',
          account_owner: '',
          iban: '',
        }
      }
    },    
  }
</script>