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
    
