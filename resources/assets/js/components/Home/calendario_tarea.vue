<template>
	<div>
		<h3>Calendario</h3>
		<kendo-scheduler :editable="false"
		                 :data-source="localDataSource"
						 :timezone="'Etc/UTC'"
						                     
						 :date="showDate"
						 :showWorkHours= "true"
						                    >
						  <kendo-scheduler-view :type="'day'"></kendo-scheduler-view>
						  <kendo-scheduler-view :type="'workWeek'"></kendo-scheduler-view>
						        <!-- <kendo-scheduler-view :type="'week'"></kendo-scheduler-view> -->
						  <kendo-scheduler-view :type="'month'" :selected="true"></kendo-scheduler-view>
						  <kendo-scheduler-view :type="'agenda'"></kendo-scheduler-view>
		</kendo-scheduler>
	</div>
</template>

<script>
	import Vue from 'vue'
	import '@progress/kendo-ui'
	import '@progress/kendo-theme-default/dist/all.css'
	import '@progress/kendo-ui/js/messages/kendo.messages.es-CL'
	import '@progress/kendo-ui/js/cultures/kendo.culture.es-CL'


	import { Scheduler } from '@progress/kendo-scheduler-vue-wrapper'
	import { SchedulerResource } from '@progress/kendo-scheduler-vue-wrapper'
	import { SchedulerView } from '@progress/kendo-scheduler-vue-wrapper'
	import { SchedulerInstaller } from '@progress/kendo-scheduler-vue-wrapper'

	Vue.use(SchedulerInstaller)
	var moment = require('moment-timezone');
	moment().tz("America/Los_Angeles").format();
	export default{
		data(){
			return{
				id_proyecto: this.$route.params.id_proyecto,
				showDate: new Date(),
				localDataSource: [],
			}
		},
		created(){
			kendo.culture("es-CL");
			this.traer_tareas();
		},
		methods:{
			traer_tareas(){
				axios.get('api/get_tarea/'+this.id_proyecto).then((res)=>{
					console.log(res.data.calendario);
					console.log("el kkck");
					if (res.data.estado == "success"){
						this.localDataSource = res.data.calendario;
						for (var i =0; i < this.localDataSource.length; i++) {
				          this.localDataSource[i].start = new Date(moment.tz(this.localDataSource[i].start, "Etc/UTC").format());
				          this.localDataSource[i].end = new Date(moment.tz(this.localDataSource[i].end, "Etc/UTC").format());
				    
				        }
					}
				});
			},
		}
	}
</script>