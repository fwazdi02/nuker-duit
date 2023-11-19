# Dockerfile for Vue.js frontend

# Use the official Node 18.16.1 image as the base image
FROM node:18.17

# Set working directory inside the container
WORKDIR /usr/src/app

# Copy package.json and package-lock.json to install dependencies
COPY ./frontend/package*.json ./

RUN npm config set fetch-retry-mintimeout 20000
RUN npm config set fetch-retry-maxtimeout 120000
RUN npm config rm proxy
RUN npm config rm https-proxy


RUN node --version
RUN npm --version

# Install dependencies
RUN npm ci
RUN npm run build

# Copy the rest of the application code
COPY ./frontend .

# Build the Vue.js app

# Expose port 8888 for the Vue.js app
EXPOSE 8888


# Start the Vue.js app
CMD ["npm", "run", "preview"]
