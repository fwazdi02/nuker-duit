# Dockerfile for Vue.js frontend

# Use the official Node 18.16.1 image as the base image
FROM node:18.17

WORKDIR /app

# Copy package.json and package-lock.json to the container
COPY ./frontend/package*.json ./

# Install project dependencies
RUN npm install serve -g
RUN npm install

# Copy the rest of the application code to the container
COPY ./frontend .

# Build the Vue.js application with Vite
RUN npm run build

# Start the Vue.js app

CMD ["npm", "run", "serve"]
EXPOSE 8888