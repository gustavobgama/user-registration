<template>
  <form-wizard @on-complete="onComplete"
               title="Create your user"
               subtitle="all fields are required">
    <tab-content title="Personal" :before-change="validateForm1">
      <el-form ref="form1" :model="user" :rules="rules" label-width="120px">
        <el-row>
          <el-col :span="8">
            <el-form-item label="First name" prop="firstname">
              <el-input v-model="user.firstname"></el-input>
            </el-form-item>
          </el-col>
          <el-col :span="8">
            <el-form-item label="Last name" prop="lastname">
              <el-input v-model="user.lastname"></el-input>
            </el-form-item>
          </el-col>
          <el-col :span="8">
            <el-form-item label="Phone" prop="phone">
              <el-input v-model="user.phone"></el-input>
            </el-form-item>
          </el-col>
        </el-row>
      </el-form>
    </tab-content>
    <tab-content title="Address" :before-change="validateForm2">
      <el-form ref="form2" :model="user" :rules="rules" label-width="120px">
        <el-row>
          <el-col :span="8">
            <el-form-item label="Address" prop="address">
              <el-input v-model="user.address"></el-input>
            </el-form-item>
          </el-col>
          <el-col :span="4">
            <el-form-item label="Number" prop="address_number">
              <el-input v-model="user.address_number"></el-input>
            </el-form-item>
          </el-col>
          <el-col :span="4">
            <el-form-item label="Zipcode" prop="zipcode">
              <el-input v-model="user.zipcode"></el-input>
            </el-form-item>
          </el-col>
          <el-col :span="8">
            <el-form-item label="City" prop="city">
              <el-input v-model="user.city"></el-input>
            </el-form-item>
          </el-col>
        </el-row>
      </el-form>
    </tab-content>
    <tab-content title="Payment" :before-change="validateForm3">
      <el-form ref="form3" :model="user" :rules="rules" label-width="120px">
        <el-row>
          <el-col :span="12">
            <el-form-item label="Account owner" prop="account_owner">
              <el-input v-model="user.account_owner"></el-input>
            </el-form-item>
          </el-col>
          <el-col :span="12">
            <el-form-item label="IBAN" prop="iban">
              <el-input v-model="user.iban"></el-input>
            </el-form-item>
          </el-col>
        </el-row>
      </el-form>
    </tab-content>
 </form-wizard>
</template>

<script>
  export default {
    props: [
      'userData',
    ],

    data() {
      return {
        user: JSON.parse(this.userData),
        rules: {
          firstname: [{
            required: true,
            message: 'Please inform the firstname',
            trigger: 'blur'
          }],
          lastname: [{
            required: true,
            message: 'Please inform the lastname',
            trigger: 'blur'
          }],
          phone: [{
            required: true,
            message: 'Please inform the phone',
            trigger: 'blur'
          }],
          address: [{
            required: true,
            message: 'Please inform the address',
            trigger: 'blur'
          }],
          address_number: [{
            required: true,
            message: 'Please inform the address number',
            trigger: 'blur'
          }],
          zipcode: [{
            required: true,
            message: 'Please inform the zipcode',
            trigger: 'blur'
          }],
          city: [{
            required: true,
            message: 'Please inform the city',
            trigger: 'blur'
          }],
          account_owner: [{
            required: true,
            message: 'Please inform the account owner',
            trigger: 'blur'
          }],
          iban: [{
            required: true,
            message: 'Please inform the iban',
            trigger: 'blur'
          }],
        },
      }
    },

    mounted() {
      // console.log(this.userData);
    },
    
    methods: {
      onComplete: function() {
        this.$alert('The user was created successfully. The Payment id is ...', 'User created', {
          confirmButtonText: 'OK',
        });
      },
      validateForm1() {
        return new Promise((resolve, reject) => {
          this.$refs.form1.validate((valid) => {
            resolve(valid);
            
            if (valid) {
              const { result } = axios.post('/user/save', { user: this.user, part: 1})
            }
          });
        });
      },
      validateForm2() {
        return new Promise((resolve, reject) => {
          this.$refs.form2.validate((valid) => {
            resolve(valid);

            if (valid) {
              const { result } = axios.post('/user/save', { user: this.user, part: 2})
            }
          });
        })
      },
      validateForm3() {
        return new Promise((resolve, reject) => {
          this.$refs.form3.validate((valid) => {
            resolve(valid);

            if (valid) {
              const { result } = axios.post('/user/save', { user: this.user, part: 3})
            }
          });
        })
      },
    },
  }
</script>