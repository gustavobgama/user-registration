<template>
  <form-wizard ref="wizard"
               title="Create your user"
               subtitle="all fields are required"
               color="#20a0ff"
               error-color="#f56c6c">
    <tab-content title="Personal" :before-change="validateForm1">
      <el-form ref="form1" :model="user" :rules="rules" :disabled="form1IsDisabled" label-width="120px">
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
    <template slot="footer" scope="props">
      <div class=wizard-footer-left>
        <el-button type="default" plain icon="el-icon-arrow-left" v-if="props.activeTabIndex > 0" @click.native="props.prevTab()">Back</el-button>
      </div>
      <div class="wizard-footer-right">
        <el-button type="default" plain icon="el-icon-arrow-right" v-if="!props.isLastStep" @click.native="props.nextTab()">Next</el-button>
        <el-button type="success" plain icon="el-icon-check" v-else @click.native="props.nextTab()" :disabled="buttonFinishIsDisabled" :loading="buttonFinishIsLoading">Finish</el-button>
      </div>
    </template>
  </form-wizard>
</template>

<script>
  export default {
    props: [
      'userData',
      'currentStep',
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
        form1IsDisabled: false,
        buttonFinishIsDisabled: false,
        buttonFinishIsLoading: false,
      }
    },

    mounted() {
      // check if empty the first field of every step and redirect the user
      let firstStep = 'firstname';
      let secondStep = 'address';
      let thirdStep = 'account_owner';
      
      if (typeof this.user[firstStep] === 'undefined' || this.user[firstStep] === '') {
        return;
      }

      if (typeof this.user[secondStep] === 'undefined' || this.user[secondStep] === '') {
        this.form1IsDisabled = true;
        this.$refs.wizard.changeTab(0, 1);
        return;
      }

      if (typeof this.user[thirdStep] === 'undefined' || this.user[thirdStep] === '') {
        this.$refs.wizard.changeTab(0, 1);
        this.$refs.wizard.changeTab(1, 2);
      }
    },
    
    methods: {
      validateForm1() {
        return new Promise((resolve, reject) => {
          this.$refs.form1.validate((valid) => {
            resolve(valid);
            
            if (valid) {
              this.form1IsDisabled = true;
              axios.post('/user/save', { user: this.user, step: 1});
            }
          });
        });
      },
      validateForm2() {
        return new Promise((resolve, reject) => {
          this.$refs.form2.validate((valid) => {
            resolve(valid);

            if (valid) {
              axios.post('/user/save', { user: this.user, step: 2});
            }
          });
        })
      },
      validateForm3() {
        return new Promise((resolve, reject) => {
          this.$refs.form3.validate((valid) => {
            resolve(valid);

            if (valid) {
              this.buttonFinishIsLoading = true;

              axios.post('/user/save', { user: this.user, step: 3}).then((response) => {
                this.buttonFinishIsLoading = false;
                this.buttonFinishIsDisabled = true;
                this.$alert(`The user was created successfully. The Payment id is ${response.data}`, 'User created', {
                  confirmButtonText: 'OK',
                });
              });
            }
          });
        })
      },
    },
  }
</script>