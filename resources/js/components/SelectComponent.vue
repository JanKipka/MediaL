<template>
    <div class="form-group">
        <label :for="selectId">{{label}}:
        </label>
        <select :id="selectId" class="form-control" v-model="selected" @change="selectChanged">
            <option v-for="data in dataArray" :value="data.id">
                {{ data.name }}
            </option>
        </select>
    </div>
</template>

<script>

    import EventBus from "./event-bus";

    export default {
        name: "SelectComponent",
        props: ['dataArray', 'selectId', 'book', 'label', 'type'],
        data() {
            return {
                selected: '',
            };
        },
        methods: {
            selectChanged() {
                this.book[this.type] = this.selected;
                EventBus.$emit(this.type + '-change', this.selected);
            }
        }
    }
</script>

<style scoped>

</style>
