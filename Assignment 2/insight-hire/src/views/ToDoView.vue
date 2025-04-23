<script setup>
import { ref } from "vue";

const newTask = ref("");
const tasks = ref([]);

// Add a new task
function addTask() {
  const trimmed = newTask.value.trim();
  console.log(trimmed);
  if (!trimmed) return;

  tasks.value.unshift({
    text: trimmed,
    priority: "Low",
  });
  console.log(
    "Text: " + tasks.value[0].text + "\nPriority: " + tasks.value[0].priority
  );
  newTask.value = "";
}

// Delete a task by index
function deleteTask(index) {
  tasks.value.splice(index, 1);
}

// Toggle task priority
function togglePriority(index) {
  const task = tasks.value[index];
  task.priority = task.priority === "High" ? "Low" : "High";
}
</script>

<template>
  <h1 class="text-center mt-5">To-Do List</h1>
  <section class="container w-75 my-5">
    <v-card class="px-5 py-3">
      <!-- Input and add button -->
      <div class="row">
        <div class="col-10">
          <v-text-field
            name="newTask"
            label="Enter New Task"
            v-model="newTask"
            @keyup.enter="addTask"
          ></v-text-field>
        </div>
        <div class="col">
          <v-btn class="bg-brown w-100 h-75" @click="addTask" block>Add</v-btn>
        </div>
      </div>

      <div>
        <v-list>
          <div
            v-for="(task, i) in tasks"
            :key="i"
            class="border rounded-3 d-flex justify-space-between align-items-center py-2 px-4 mb-3"
          >
            <h4 class="mt-2">{{ task.text }} ({{ task.priority }} Priority)</h4>

            <div>
              <v-btn
                variant="outlined"
                class="mx-1 text-brown"
                @click="togglePriority(i)"
              >
                Mark as {{ task.priority === "Low" ? "High" : "Low" }} Priority
              </v-btn>
              <v-btn color="error" @click="deleteTask(i)">Delete</v-btn>
            </div>
          </div>
        </v-list>
      </div>
    </v-card>
  </section>
</template>

<style scoped></style>
