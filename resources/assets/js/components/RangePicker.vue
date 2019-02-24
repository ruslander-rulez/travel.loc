<template>
    <date-picker
            v-model="date"
            range
            confirm
            lang="ru"
            :shortcuts="shortcuts"
            :first-day-of-week="1"
            @confirm="confirm"
    ></date-picker>
</template>

<script>
    import DatePicker from 'vue2-datepicker'
    let  now = new Date();
    let thisWeekFirstday = new Date().setDate(now.getDate() + 1 - now.getDay());
    let prevWeekFirstday = new Date(now.getFullYear(),now.getMonth(), now.getDate() - 6 - now.getDay());
    let prevWeekLastday = new Date(now.getFullYear(),now.getMonth(), now.getDate() - now.getDay());
    let lastDayOfMonth = new Date(now.getFullYear(), now.getMonth()+1, 0);

    let i = now.getMonth() == 0 ? 1 : 0;
    let pevMonthLastDayOfMonth = new Date(now.getFullYear()-i, now.getMonth(), 0);

    export default {
        components: { DatePicker },
        name: "RangePicker",
        data() {
          return {
              date:[],
              shortcuts: [
                  {
                      text: "Текущий месяц",
                      start: new Date(now.getFullYear(), lastDayOfMonth.getMonth(),1),
                      end: new Date()
                  },
                  {
                      text: "Прошлый месяц",
                      start: new Date(now.getFullYear()-i, pevMonthLastDayOfMonth.getMonth(),1),
                      end: new Date(now.getFullYear()-i, now.getMonth(), 0)
                  }
              ]
          }
        },
        props: ["inputDate"],
        mounted() {
            setTimeout(() => {
                this.date = this.inputDate
            },200)

        },
        methods: {
            confirm: function () {
                this.$emit("change", Object.assign({}, this.date))
            }
        }

    }
</script>

<style>
    .mx-datepicker-popup {
        z-index: 9999;
    }
</style>