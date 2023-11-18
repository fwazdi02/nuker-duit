<script setup></script>

<template>
  <div>
    <n-card title="Summary">
      <n-table :bordered="false" :single-line="false">
        <thead>
          <tr>
            <th>Currency</th>
            <th>Total Buy</th>
            <th>Total Sell</th>
            <th>Available Amount</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>JPY</td>
            <td>1200</td>
            <td>1200</td>
            <td>7000</td>
          </tr>
        </tbody>
      </n-table>
    </n-card>
  </div>
</template>

<style></style>
