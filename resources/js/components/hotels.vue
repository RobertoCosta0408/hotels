<template>
  
<div class="hero-body">
<div class="container">

  <h1 class="title has-text-centered">Fill the form to help you find your Hotel</h1>
  <div class="box">

    
    <form action="./api/hotels" method="GET" @submit.prevent="getHotels()">
      <div class="form-group">
        <input 
                type="date"
                name="startDate"
                v-model="startDate"
                placeholder="Start Date"
                class="form-control" 
                >
        <input 
                type="date"
                name="endDate"
                v-model="endDate"
                placeholder="End Date"
                class="form-control" 
                >
        <input 
                type="integer"
                name="adults"
                v-model="adults"
                placeholder="number of adults"
                class="form-control" 
                >
        <input 
                type="integer"
                name="children"
                v-model="children"
                placeholder="number of children"
                class="form-control" 
                >
        <input 
                type="integer"
                name="childrensAge"
                v-model="childrensAge"
                placeholder="children age"
                class="form-control" 
                >
      </div>
      <div class="form-group">
        <input type="submit" value="submit">
      </div>
    </form>

   <div v-for="message in messages" v-bind:key="message">
    <div class="fade-in">
      <div >
        <div class="message last">
          <b>Text: </b>{{message.text}}
          <br>
          <b>Room Size: </b>{{message.sizeMeasurement}}
          <br>
          <b>Price: </b>{{message.amountAfterTax}} {{message.currencyCode}}
          <br>
          <b>Max Occupancy: </b>{{message.maxOccupancy}}
        </div>
        <br>
        <br>
      </div>
    </div>
  </div>

</div>
</div>
</div>
</template>
<script>
const default_layout = "default";
import axios from 'axios'
export default {
  data(){
    return{
      startDate: '',
      endDate: '',
      adults: '',
      children: '',
      childrensAge: '',
      responseData: '',
      messages:[],
    }
  },
  mounted(){
    console.log('mounted')
  },

  methods:{
    getHotels(){
      axios.post('./api/hotels', 
      {
        startDate: this.startDate,
        endDate: this.endDate,
        adults: this.adults,
        children: this.children,
        childrensAge: this.childrensAge
      }
      
      )
      .then(response => {
        console.log(response.data)
        this.messages=response.data
      })
      //alert('adasa')
    }
  }
};
</script>