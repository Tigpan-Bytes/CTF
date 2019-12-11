mins = 15

import tkinter as tk
from time import sleep
from math import floor
from tkinter import filedialog
from os import listdir, unlink
from os.path import isfile, join
from shutil import copy

root = tk.Tk()

main_path = filedialog.askdirectory()

class Timer:
    def __init__(self, parent):
        self.seconds = int(mins * 60)
        self.label = tk.Label(parent, text=str(mins) + ":00" , font="Arial 256")
        self.label.pack(expand=True, fill='both')
        self.label.after(1000, self.refresh_label)

    def refresh_label(self):
        self.seconds -= 1
        
        if self.seconds <= 0:
            self.seconds = int(mins * 60)
            
        if self.seconds % 60 < 10:
            text = str(floor(self.seconds / 60)) + ":0" + str(self.seconds % 60)
        else:
            text = str(floor(self.seconds / 60)) + ":" + str(self.seconds % 60)
        self.label.configure(text=text)
        
        self.label.after(1000, self.refresh_label)

timer = Timer(root)
root.mainloop()
    
        



