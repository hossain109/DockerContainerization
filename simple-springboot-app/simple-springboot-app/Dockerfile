      # Use the official Maven image to build the application
      FROM maven:3.8.1-openjdk-11 AS build
      
      # Set the working directory
      WORKDIR /app
      
      # Copy the pom.xml file and install dependencies
      COPY pom.xml .
      RUN mvn dependency:go-offline
      
      # Copy the rest of the application code
      COPY src ./src
      
      # Package the application with mvn
      RUN mvn package -DskipTests
      
      # Use the official OpenJDK image as the base image for the runtime
      FROM openjdk:11-jre-slim
      
      # Set the working directory
      WORKDIR /app
      
      # Copy the packaged jar file from the build stage
      COPY --from=build /app/target/demo-0.0.1-SNAPSHOT.jar ./demo.jar
      
      # Expose the port the app runs on
      EXPOSE 8080
      
      # Command to run the app
      CMD ["java", "-jar", "demo.jar"]