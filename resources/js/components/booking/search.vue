<template>
  <div>
    <div class="row" id="filtrSection">
      <div class="col-md-3">
        <label for="exampleInputEmail1">CheckIn Date</label>
        <input v-model="checkInDate" id="checkInDate" class="form-control" type="date" />
      </div>
      <div class="col-md-3">
        <label for="exampleInputEmail1">CheckOut Date</label>
        <input  v-model="checkOutDate" id="checkOutDate" class="form-control" type="date" />
      </div>
      <div class="col-md-3">
        <label for="exampleInputEmail1">Room Types</label>
        <select
          v-model="roomTypeId"
          class="form-select"
          name="room_type_id"
          aria-label="Default select example"
        >
            <option value="null"> Select Type</option>
          <option v-for="type in types" :value="type.id">
            {{ type.name }}
          </option>
        </select>
      </div>
      <div class="col-md-3">
        <input
          type="button"
          id="search"
          value="search"
          style="margin-top: 20px"
          class="form-control btn btn-success"
          @click="fetchRooms()"
        />
      </div>
    </div>
    <div class="row" style="margin-top: 20px">
      <div class="col-md-12">
        <div
          v-for="room in rooms"
          class="card"
          style="width: 18rem; float: left; margin: 5px"
        >
          <div class="card-body">
            <h5 class="card-title">Room Number : {{ room.id }}</h5>
            <h6>
                {{ room.type.name }}
                <a :href="('booking/create/'+room.id+'?checkin_date='+this.checkInDate+'&checkout_date='+this.checkOutDate)" style="float:right"  class="btn btn-sm btn-success">Book Now</a>
            </h6>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["types"],
  data() {
    return {
      roomTypeId:null,
      checkInDate: null,
      checkOutDate: null,
      rooms: [],
      roomTypes: [],
    };
  },
  created() {
    this.fetchRooms();
  },
  methods: {
    fetchRooms() {
      axios.get("booking/available-rooms?checkInDate="+this.checkInDate+"&checkOutDate="+this.checkOutDate+"&roomTypeId="+this.roomTypeId).then((response) => {
        console.log(response.data.data);
        this.rooms = response.data.data;
      });
    },
  },
 
};
</script>
