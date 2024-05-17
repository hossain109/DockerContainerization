# DockerContainerization
Docker installation, Creation image and Containerization

## Files and Folders in containers base images
    
        /bin: contains binary executable files, such as the ls, cp, and ps commands.

        /sbin: contains system binary executable files, such as the init and shutdown commands.

        /etc: contains configuration files for various system services.

        /lib: contains library files that are used by the binary executables.

        /usr: contains user-related files and utilities, such as applications, libraries, and documentation.

        /var: contains variable data, such as log files, spool files, and temporary files.

        /root: is the home directory of the root user.

## Files and Folders that containers use from host operating system

            The host's file system: Docker containers can access the host file system using bind mounts, which allow the container to read and write files in the host file                 system.

             Networking stack: The host's networking stack is used to provide network connectivity to the container. Docker containers can be connected to the host's network                 directly or through a virtual network.

            System calls: The host's kernel handles system calls from the container, which is how the container accesses the host's resources, such as CPU, memory, and I/O.

            Namespaces: Docker containers use Linux namespaces to create isolated environments for the container's processes. Namespaces provide isolation for resources such                 as the file system, process ID, and network.

            Control groups (cgroups): Docker containers use cgroups to limit and control the amount of resources, such as CPU, memory, and I/O, that a container can access.

## Docker LifeCycle
We can use the above Image as reference to understand the lifecycle of Docker.

There are three important things,

- docker build -> builds docker images from Dockerfile
- docker run -> runs container from docker images
- docker push -> push the container image to public/private regestries to share the docker images.

### Understanding the terminology (Inspired from Docker Docs)
#### Docker daemon
The Docker daemon (dockerd) listens for Docker API requests and manages Docker objects such as images, containers, networks, and volumes. A daemon can also communicate with other daemons to manage Docker services.

#### Docker client
The Docker client (docker) is the primary way that many Docker users interact with Docker. When you use commands such as docker run, the client sends these commands to dockerd, which carries them out. The docker command uses the Docker API. The Docker client can communicate with more than one daemon.

#### Docker Desktop
Docker Desktop is an easy-to-install application for your Mac, Windows or Linux environment that enables you to build and share containerized applications and microservices. Docker Desktop includes the Docker daemon (dockerd), the Docker client (docker), Docker Compose, Docker Content Trust, Kubernetes, and Credential Helper. For more information, see Docker Desktop.

#### Docker registries
A Docker registry stores Docker images. Docker Hub is a public registry that anyone can use, and Docker is configured to look for images on Docker Hub by default. You can even run your own private registry.

When you use the docker pull or docker run commands, the required images are pulled from your configured registry. When you use the docker push command, your image is pushed to your configured registry. Docker objects

When you use Docker, you are creating and using images, containers, networks, volumes, plugins, and other objects. This section is a brief overview of some of those objects.

#### Dockerfile
Dockerfile is a file where you provide the steps to build your Docker Image.

#### Images
An image is a read-only template with instructions for creating a Docker container. Often, an image is based on another image, with some additional customization. For example, you may build an image which is based on the ubuntu image, but installs the Apache web server and your application, as well as the configuration details needed to make your application run.

You might create your own images or you might only use those created by others and published in a registry. To build your own image, you create a Dockerfile with a simple syntax for defining the steps needed to create the image and run it. Each instruction in a Dockerfile creates a layer in the image. When you change the Dockerfile and rebuild the image, only those layers which have changed are rebuilt. This is part of what makes images so lightweight, small, and fast, when compared to other virtualization technologies.

## INSTALL DOCKER
A very detailed instructions to install Docker are provide in the below link

https://docs.docker.com/get-docker/

For Demo,

You can create an Ubuntu EC2 Instance on AWS and run the below commands to install docker.
        sudo apt update
        sudo apt install docker.io -y

## Start Docker daemon
You use the below command to verify if the docker daemon is actually started and Active

        sudo systemctl status docker
        
If you notice that the docker daemon is not running, you can start the daemon using the below command

        sudo systemctl start docker

## Grant Access to your user to run docker commands
To grant access to your user to run the docker command, you should add the user to the Docker Linux group. Docker group is create by default when docker is installed.

        sudo usermod -aG docker ubuntu
        
In the above command ubuntu is the name of the user, you can change the username appropriately.

NOTE: : You need to logout and login back for the changes to be reflecte

### Docker is Installed, up and running 🥳🥳
Use the same command again, to verify that docker is up and running.
        docker run hello-world

### Login to Docker [Create an account with https://hub.docker.com/]
        docker login

### Build your first Docker Image
You need to change the username accoringly in the below command
        docker build -t docker_image:latest .

### Verify Docker Image is created
            docker images

### Run your First Docker Container
            docker run -it docker-image

### Push the Image to DockerHub and share it with the world
            docker push docker-image
    
