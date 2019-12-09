import tkinter as tk
from tkinter import filedialog
from os import listdir, unlink
from os.path import isfile, join
from shutil import copy

root = tk.Tk()
root.withdraw()

bot_path = filedialog.askdirectory() + '/bots'
for file in listdir(bot_path):
    file_loc = join(bot_path, file)
    if isfile(file_loc):
        unlink(file_loc)
        
for dir in listdir('.'):
    dir_loc = join('.', dir)
    if not isfile(dir_loc):
        for file in listdir(dir):
            file_loc = join(dir_loc, file)
            if isfile(file_loc):
                copy(file_loc, bot_path)
        
