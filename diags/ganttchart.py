import matplotlib.pyplot as plt
import matplotlib.dates as mdates
from datetime import datetime, timedelta

# Task details
tasks = [
    "Requirement Gathering and Analysis",
    "Feasibility Study",
    "Finalizing System Requirements",
    "Create System Diagrams",
    "UI/UX Design",
    "Finalize Architecture Design",
    "Backend Development",
    "Frontend Development",
    "Database Setup",
    "Unit Testing",
    "Integration Testing",
    "Deployment",
    "User Manual and Developer Documentation",
    "Final Review and Handover"
]

start_dates = [
    datetime(2024, 11, 26),
    datetime(2024, 11, 30),
    datetime(2024, 12, 3),
    datetime(2024, 12, 7),
    datetime(2024, 12, 10),
    datetime(2024, 12, 14),
    datetime(2024, 12, 18),
    datetime(2024, 12, 19),
    datetime(2024, 12, 20),
    datetime(2024, 12, 22),
    datetime(2024, 12, 23),
    datetime(2024, 12, 26),
    datetime(2024, 12, 29),
    datetime(2024, 12, 31)
]

durations = [
    4, 3, 4, 3, 4, 4, 6, 3, 3, 4, 2, 3, 4, 2
]

# Create a figure and axis
fig, ax = plt.subplots(figsize=(14, 7))

# Generate Gantt chart bars
for i, task in enumerate(tasks):
    # Calculate the end date for each task based on its duration
    end_date = start_dates[i] + timedelta(days=durations[i])
    
    # Plot the task as a horizontal bar
    ax.barh(task, durations[i], left=start_dates[i], color='skyblue', edgecolor='black')

# Format the x-axis
ax.xaxis.set_major_formatter(mdates.DateFormatter('%b %d'))
ax.xaxis.set_major_locator(mdates.WeekdayLocator(interval=1))
plt.xticks(rotation=45)

# Labels and title
ax.set_xlabel('Timeline')
ax.set_ylabel('Tasks')
ax.set_title('EduNexus Gantt Chart - Virtual Classroom Reminder App')

# Display the chart
plt.tight_layout()
plt.show()
